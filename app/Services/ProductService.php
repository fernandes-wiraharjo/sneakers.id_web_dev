<?php
namespace App\Services;

use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\File;
use Modules\Transaction\Entities\TransactionItems;

class ProductService {
    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function uploadImagetoBuckets($request){
        $path = 'images/upload-buckets';

        if (!imageIsExist($path, '0_'.$request['file']->getClientOriginalName())){
            $do_upload = imageUploadtoBucket($request['file'], $path ,'public', true, 0);
            return $do_upload;
        }

        return false;
    }

	public function insertProduct($request){
        $product = [
            'product_code' => $request['product_code'],
            'product_name' => $request['product_name'],
            'product_link' => $request['product_link'],
            'shopee_link' => $request['shopee_link'],
            'blibli_link' => $request['blibli_link'],
            'description' => $request['description'],
            'is_active' => $request['is_active']
        ];

        $insertedProduct = $this->productRepository->createProduct($product);

        if($insertedProduct) {
            $idNewProduct = $insertedProduct->id;

            $afterPath = 'images/products/'.$request['product_code'];
            $beforePath = 'images/upload-buckets';

            if(isset($request['products_image'])){
                foreach($request['products_image'] as $key=>$image){
                    // $do_upload = imageUploadProduct($image, $path ,'public', true, $no);
                    $checkFileExists = imageIsExist($beforePath, $image);
                    $checkFile1200isExists = imageIsExist($beforePath, str_replace("1800x1800", "1200x1200", $image));
                    if ($checkFileExists && $checkFile1200isExists) {
                        $do_move = moveImage($beforePath, $afterPath, $image);
                        $do_move = moveImage($beforePath, $afterPath, str_replace("1800x1800", "1200x1200", $image));

                        if(!$do_move){
                            abort(500, 'Failed upload image');
                        } else {
                            $productImage = [
                                'product_id' => $idNewProduct,
                                'image_url' => $image
                            ];

                            $this->productRepository->insertProductImage($productImage);

                            if(isset($request['is_main'])){
                                $getProduct = $this->productRepository->getProductById($idNewProduct);

                                if($getProduct) {
                                    $getProduct->image = $request['is_main'];
                                    $getProduct->save();
                                }
                            }
                        }

                    }
                }
            }

            if(isset($request['size_price'])) {
                foreach($request['size_price'] as $item){
                    if(isset($item['update_size'])){
                        $inserted_product_detail = $this->productRepository->insertProductDetails([
                            'product_id' => $idNewProduct,
                            'brand_id' => $request['brand_id'],
                            'size' => $item['size'],
                            'qty' => intval($item['qty']),
                            'weight' => intval($item['weight']),
                            'base_price' => str_replace('.','',$item['base_price']),
                            'retail_price' => str_replace('.','',$item['retail_price']),
                            'after_discount_price' => str_replace('.','',$item['after_discount_price']),
                            'discount_percentage' => intval($item['discount_percentage'])
                        ]);

                        if(!$inserted_product_detail){
                            return false;
                        }
                    }
                }
            }


            // $sizes = json_decode($request['size']);
            $categories = json_decode($request['category']);
            $tags = json_decode($request['tag']);
            $signatures = json_decode($request['signature']);

            // $sizes_id = [];
            $categories_id = [];
            $tags_id = [];
            $signatures_id = [];

            // if(isset($sizes)){
            //     foreach($sizes as $item){
            //         $sizes_id[] = $item->id;
            //     }

            //     $this->productRepository->attachProductSizes($idNewProduct, $sizes_id);
            // }

            if(isset($categories)){
                foreach($categories as $item){
                    $categories_id[] = $item->id;
                }

                $this->productRepository->attachProductCategories($idNewProduct, $categories_id);
            }

            if(isset($tags)){
                foreach($tags as $item){
                    $tags_id[] = $item->id;
                }

                $this->productRepository->attachProductTags($idNewProduct, $tags_id);
            }

            if(isset($signatures)){
                foreach($signatures as $item){
                    $signatures_id[] = intval($item->value);
                }

                $this->productRepository->attachProductSignatures($idNewProduct, $signatures_id);
            }

        }

        return true;
	}

    public function updateProduct($id, $request){
        $message = '';
        $product = [
            'product_code' => $request['product_code'],
            'product_name' => $request['product_name'],
            'product_link' => $request['product_link'],
            'shopee_link' => $request['shopee_link'],
            'blibli_link' => $request['blibli_link'],
            'description' => $request['description'],
            'is_active' => $request['is_active']
        ];
        $getProduct = $this->productRepository->getProductById($id);
        $oldDetail = $getProduct->details()->pluck('id')->toArray();
        $detail_ids = [];

        foreach ($request['size_price'] as $sub_array) {
            $detail_ids[] = intval($sub_array['detail_id']);
        }

        $beforeProductCode = $getProduct->product_code;

        $updatedProduct = $getProduct->update($product);

        if($updatedProduct) {
            $afterPath = 'images/products/'.$request['product_code'];
            $beforePath = 'images/upload-buckets';

            if($beforeProductCode != $request['product_code']){
                $image_path = 'images/products/'.$beforeProductCode;

                File::copyDirectory($image_path, $afterPath);
                File::deleteDirectory($image_path);
            }

            if(isset($request['remove_image'])){
                foreach($request['remove_image'] as $removed_file){
                    if(in_array($removed_file ,$request['before_image'])){
                        removeImageFromStorage($afterPath, $removed_file);
                        $deleted = $this->productRepository->deleteProductImageByImageId($removed_file, $id);
                    }
                }
            }

            if(isset($request['products_image'])){
                foreach($request['products_image'] as $key=>$image){
                    // $do_upload = imageUploadProduct($image, $path ,'public', true, $no);
                    $checkFileExists = imageIsExist($beforePath, $image);
                    $checkFile1200isExists = imageIsExist($beforePath, str_replace("1800x1800", "1200x1200", $image));
                    if ($checkFileExists && $checkFile1200isExists) {
                        $do_move = moveImage($beforePath, $afterPath, $image);
                        $do_move = moveImage($beforePath, $afterPath, str_replace("1800x1800", "1200x1200", $image));
                        if(!$do_move){
                            abort(500, 'Failed upload image');
                        } else {
                            $productImage = [
                                'product_id' => $id,
                                'image_url' => $image
                            ];

                            $this->productRepository->insertProductImage($productImage);
                        }

                    }
                }
            }

            if(isset($request['is_main'])){
                $getProduct = $this->productRepository->getProductById($id);

                if($getProduct) {
                    $getProduct->image = $request['is_main'];
                    $getProduct->save();
                }
            }

            //sync unused file
            $imagePack = $getProduct->images()->pluck('image_url')->toArray();
            foreach (File::allFiles(public_path($afterPath)) as $file) {
                // $getProduct = $this->productRepository->getProductByCode($request['product_code']);
                if(!in_array($file->getFilename(), $imagePack) && !(strpos($file->getFilename(), "1800x1800") !== false) && !(strpos($file->getFilename(), "1200x1200") !== false)){
                    removeImageFromStorage($afterPath, $file->getFilename());
                }
            }

            if($diff = array_diff($oldDetail, $detail_ids)){
                foreach($diff as $itemDiff) {
                    $check_transactions = TransactionItems::where('product_detail_id', $itemDiff)->first();
                    if(!$check_transactions) {
                        $this->productRepository->deleteProductDetail($itemDiff);
                    } else {
                        $message = 'Success Update, size is contain transaction';
                    }
                }
            }

            foreach($request['size_price'] as $item){
                if(isset($item['update_size'])){
                    if(isset($item['detail_id'])) {
                        $this->productRepository->updateProductDetails($item['detail_id'] ,[
                            'brand_id' => $request['brand_id'],
                            'size' => $item['size'],
                            'qty' => intval($item['qty']),
                            'weight' => intval($item['weight']),
                            'base_price' => str_replace('.','',$item['base_price']),
                            'retail_price' => str_replace('.','',$item['retail_price']),
                            'after_discount_price' => str_replace('.','',$item['after_discount_price']),
                            'discount_percentage' => intval($item['discount_percentage'])
                        ]);
                    } else {
                        $this->productRepository->insertProductDetails([
                            'product_id' => $id,
                            'brand_id' => $request['brand_id'],
                            'size' => $item['size'],
                            'weight' => intval($item['weight']),
                            'base_price' => str_replace('.','',$item['base_price']),
                            'retail_price' => str_replace('.','',$item['retail_price']),
                            'after_discount_price' => str_replace('.','',$item['after_discount_price']),
                            'discount_percentage' => intval($item['discount_percentage'])
                        ]);
                    }
                }
            }

            // $getProduct->detail()->update([
            //     'brand_id' => $request['brand_id'],
            //     'qty' => $request['qty'],
            //     'base_price' => str_replace('.','',$request['base_price']),
            //     'retail_price' => str_replace('.','',$request['retail_price']),
            //     'after_discount_price' => str_replace('.','',$request['after_discount_price']),
            //     'discount_percentage' => intval($request['discount_percentage'])
            // ]);

            // $sizes = json_decode($request['size']);
            $categories = json_decode($request['category']);
            $tags = json_decode($request['tag']);
            $signatures = json_decode($request['signature']);

            // $sizes_id = [];
            $categories_id = [];
            $tags_id = [];
            $signatures_id = [];

            // if(isset($sizes)){
            //     foreach($sizes as $item){
            //         $sizes_id[] = $item->id;
            //     }

            //     $this->productRepository->syncProductSizes($id, $sizes_id);
            // }   else {
            //     $this->productRepository->syncProductSizes($id);
            // }

            if(isset($categories)){
                foreach($categories as $item){
                    $categories_id[] = $item->id;
                }

                $this->productRepository->syncProductCategories($id, $categories_id);
            }  else {
                $this->productRepository->syncProductCategories($id);
            }

            if(isset($tags)){
                foreach($tags as $item){
                    $tags_id[] = $item->id;
                }

                $this->productRepository->syncProductTags($id, $tags_id);
            } else {
                $this->productRepository->syncProductTags($id);
            }

            if(isset($signatures)){
                foreach($signatures as $item){
                    $signatures_id[] = intval($item->value);
                }

                $this->productRepository->syncProductSignatures($id, $signatures_id);
            } else {
                $this->productRepository->syncProductSignatures($id);
            }
        }
        return ['status' => true, 'message' => $message];
    }

    public function generateProductCode()
    {
        $new_code = '';
        $prefix = 'SNEAKERS';
        $period = Carbon::now()->format('Ym');

        $latest_code = $this->productRepository->getLatestProductCode();

        if ($latest_code) {
            $latest_sequence = explode("_", $latest_code)[1] ?? 0;
            $new_sequence = $latest_sequence + 1;
            $formatted_sequence = str_pad($new_sequence, 4, '0', STR_PAD_LEFT);
            $new_code = $prefix . '_' . $formatted_sequence;
        } else {
            $new_code =  $prefix . '_' . '0001';
        }

        return $new_code;
    }

    public function readFiles($request)
    {
        $getProduct = $this->productRepository->getProductByCode($request['product_code']);
        $imagePack = $getProduct->images()->pluck('image_url')->toArray();
        //get code
        //get data images
        $directory = 'images/products/'.$request['product_code'];
        $files_info = [];
        $file_ext = array('png','jpg','jpeg','pdf');

        // Read files
        foreach (File::allFiles(public_path($directory)) as $file) {
            $extension = strtolower($file->getExtension());
            // check file in database & in file directory
            if(in_array($file->getFilename(), $imagePack)){
                if(in_array($extension,$file_ext)){ // Check file extension
                    $filename = $file->getFilename();
                    $size = $file->getSize(); // Bytes
                    $sizeinMB = round($size / (1000 * 1024), 2);// MB

                    if($sizeinMB <= 2){ // Check file size is <= 2 MB
                        $files_info[] = array(
                            "name" => $filename,
                            "size" => $size,
                            "path" => url($directory.'/'.$filename)
                        );
                    }
                }
            }
        }
        return $files_info;
    }

    public function updateProductbyExcel($data){
        //Harga awal mewakili base price dan retail price
        //foreach find by article number, get id
        //find product_details by id and size, update or insert
        //file not saved
        $data_raw = json_decode($data["data-raw"]);
        foreach($data_raw as $item){
            //find products by article number get ID
            $products = $this->productRepository->getProductByCode($item->product_code);
            $products->update(['product_name' => $item->product_name]);
            $products_details = $this->productRepository->getProductDetailByIdAndSize($products->id, $item->size);
            if($products_details->count() > 0) {
                $products_details->update(
                    [
                        'base_price' => $item->base_price ? str_replace('.','',$item->base_price) : 0,
                        'retail_price' => $item->base_price ? str_replace('.','',$item->base_price) : 0,
                        'after_discount_price' => $item->after_discount_price ? str_replace('.','',$item->after_discount_price ) : 0,
                        'discount_percentage' => $item->discount_percentage ? $item->discount_percentage : 0,
                        'qty' => $item->qty ? $item->qty : 0
                    ]
                );
            } else {
                $brand_id = $products->detail()->first()->brand_id;

                $this->productRepository->insertProductDetails([
                    'product_id' => $products->id,
                    'brand_id' => $brand_id,
                    'size' => $item->size,
                    'qty' => $item->qty ? intval($item->qty) : 0,
                    'base_price' => $item->base_price ? str_replace('.','',$item->base_price) : 0,
                    'retail_price' => $item->base_price ? str_replace('.','',$item->base_price) : 0,
                    'after_discount_price' => $item->after_discount_price ? str_replace('.','',$item->after_discount_price) : 0,
                    'discount_percentage' => $item->discount_percentage ? intval($item->discount_percentage) : 0
                ]);
            }
            //find product_details by id & size updates new data
        }

        return true;
    }

    public function validateArticleNumber($data){
        // dd($data['data']);

        $data_not_match = [];
        $data_match = [];
        foreach($data['data'] as $item){
            $result = $this->productRepository->getProductByCode($item['product_code']);

            if(!$result){
                $data_not_match[] = $item['product_code'];
                continue;
            }

            $data_match[] = $item;
        }

        if(count($data_not_match) > 0) {
            return ['status' => 404, 'data' => json_encode($data_not_match)];
        }

        return ['status' => 200, 'data' => json_encode($data_match)];
    }
}
