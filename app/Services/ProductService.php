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
        //dd($request);
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
                foreach($request['product_image'] as $image){
                    dump($image);
                    $do_upload = imageUpload($image, $path ,'public');

                    if(!$do_upload){
                        abort(500, 'Failed upload image');
                    } else {
                        $productImage = [
                            'product_id' => $idNewProduct,
                            'image_url' => $do_upload
                        ];

                        //$this->productRepository->insertProductImage($productImage);
                    }

                }
            }

            dd($idNewProduct);
        }

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
        }

        if(isset($categories)){
            foreach($categories as $item){
                $categories_id[] = $item->id;
            }
        }

        if(isset($tags)){
            foreach($tags as $item){
                $tags_id[] = $item->id;
            }
        }

        if(isset($sizes)){
            foreach($signatures as $item){
                $signatures_id[] = intval($item->value);
            }
        }

        dd([$sizes_id, $categories_id, $tags_id, $signatures_id]);

	}

    public function updateProduct($request){

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
