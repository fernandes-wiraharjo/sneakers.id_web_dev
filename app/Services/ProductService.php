<?php
namespace App\Services;

use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use Carbon\Carbon;

class ProductService {
    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

	public function insertProduct($request){

        $product = [
            'product_code' => $request['product_code'],
            'product_name' => $request['product_name'],
            'product_link' => $request['product_link'],
            'description' => $request['description'],
            'is_active' => $request['is_active']
        ];

        $insertedProduct = $this->productRepository->createProduct($product);

        if($insertedProduct) {
            $idNewProduct = $insertedProduct->id;

            $path = 'images/products';

            if(isset($request['product_image'])){
                $no = 1;

                foreach($request['product_image'] as $image){

                    $do_upload = imageUpload($image, $path ,'public', true, $no);

                    if(!$do_upload){
                        abort(500, 'Failed upload image');
                    } else {
                        $productImage = [
                            'product_id' => $idNewProduct,
                            'image_url' => $do_upload
                        ];

                        $this->productRepository->insertProductImage($productImage);
                    }

                    $no++;
                }
            }

            $this->productRepository->insertProductDetails([
                'product_id' => $idNewProduct,
                'brand_id' => $request['brand_id'],
                'qty' => $request['qty'],
                'base_price' => str_replace('.','',$request['base_price']),
                'retail_price' => str_replace('.','',$request['retail_price']),
                'after_discount_price' => str_replace('.','',$request['after_discount_price'])
            ]);

            $sizes = json_decode($request['size']);
            $categories = json_decode($request['category']);
            $tags = json_decode($request['tag']);
            $signatures = json_decode($request['signature']);

            $sizes_id = [];
            $categories_id = [];
            $tags_id = [];
            $signatures_id = [];

            if(isset($sizes)){
                foreach($sizes as $item){
                    $sizes_id[] = $item->id;
                }

                $this->productRepository->attachProductSizes($idNewProduct, $sizes_id);
            }

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

            if(isset($sizes)){
                foreach($signatures as $item){
                    $signatures_id[] = intval($item->value);
                }

                $this->productRepository->attachProductSignatures($idNewProduct, $signatures_id);
            }

        }

        return true;
	}

    public function updateProduct($id, $request){
        $product = [
            'product_code' => $request['product_code'],
            'product_name' => $request['product_name'],
            'product_link' => $request['product_link'],
            'description' => $request['description'],
            'is_active' => $request['is_active']
        ];

        $getProduct = $this->productRepository->getProductById($id);

        $updatedProduct = $getProduct->update($product);

        if($updatedProduct) {
            $path = 'images/products';

            if(isset($request['product_image'])){
                $no = 1;

                $this->productRepository->deleteProductImage($id);

                foreach($request['product_image'] as $image){

                    $do_upload = imageUpload($image, $path ,'public', true, $no);

                    if(!$do_upload){
                        abort(500, 'Failed upload image');
                    } else {
                        $productImage = [
                            'product_id' => $id,
                            'image_url' => $do_upload
                        ];

                        $this->productRepository->insertProductImage($productImage);
                    }

                    $no++;
                }
            }

            $getProduct->detail()->update([
                'brand_id' => $request['brand_id'],
                'qty' => $request['qty'],
                'base_price' => str_replace('.','',$request['base_price']),
                'retail_price' => str_replace('.','',$request['retail_price']),
                'after_discount_price' => str_replace('.','',$request['after_discount_price'])
            ]);

            $sizes = json_decode($request['size']);
            $categories = json_decode($request['category']);
            $tags = json_decode($request['tag']);
            $signatures = json_decode($request['signature']);

            $sizes_id = [];
            $categories_id = [];
            $tags_id = [];
            $signatures_id = [];

            if(isset($sizes)){
                foreach($sizes as $item){
                    $sizes_id[] = $item->id;
                }

                $this->productRepository->syncProductSizes($id, $sizes_id);
            }

            if(isset($categories)){
                foreach($categories as $item){
                    $categories_id[] = $item->id;
                }

                $this->productRepository->syncProductCategories($id, $categories_id);
            }

            if(isset($tags)){
                foreach($tags as $item){
                    $tags_id[] = $item->id;
                }

                $this->productRepository->syncProductTags($id, $tags_id);
            }

            if(isset($sizes)){
                foreach($signatures as $item){
                    $signatures_id[] = intval($item->value);
                }

                $this->productRepository->syncProductSignatures($id, $signatures_id);
            }
        }

        return true;
    }

    public function generateProductCode()
    {
        $new_code = '';
        $prefix = 'SNEAKERS';
        $period = Carbon::now()->format('Ym');

        $latest_code = $this->productRepository->getLatestProductCode();

        if ($latest_code) {
            $latest_sequence = explode("_", $latest_code)[1];
            $new_sequence = $latest_sequence + 1;
            $formatted_sequence = str_pad($new_sequence, 4, '0', STR_PAD_LEFT);
            $new_code = $prefix . '_' . $formatted_sequence;
        } else {
            $new_code =  $prefix . '_' . '0001';
        }

        return $new_code;
    }
}
