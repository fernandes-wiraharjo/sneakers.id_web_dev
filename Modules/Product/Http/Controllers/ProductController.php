<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Entities\ProductDatatables;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Size\Repositories\SizeRepository;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductDetail;
use App\Services\ProductService;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Response;

class ProductController extends Controller
{
    protected $repository;
    private $brandRepository;
    private $productService;
    private $sizeRepository;

    public function __construct(ProductRepository $repository, BrandRepository $brandRepository, ProductService $productService, SizeRepository $sizeRepository) {
        $this->repository = $repository;
        $this->brand = $brandRepository;
        $this->service = $productService;
        $this->size = $sizeRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProductDatatables $dataTable)
    {
        ladmin()->allow('administrator.product.index');
        return $dataTable->render('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.product.create');
        $data['product'] = new Product();
        $data['brand'] = $this->brand->getBrandIdAndName();
        $data['product_code'] = $this->service->generateProductCode();
        $data['size'] = $this->size->getAllSizes();
        cleanDirectory('images/upload-buckets');

        return view('product::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $size_price = $request->size_price;

            if(isset($request['size_price'])) {
                foreach($size_price as $index => $item){
                    if(isset($item['update_size'])){
                        // dd(intval( str_replace('.','',$item['base_price'])));
                        $size_price[$index]['base_price'] = intval( str_replace('.','',$item['base_price']));
                        $size_price[$index]['retail_price'] = intval(str_replace('.','',$item['retail_price'] ));
                        $size_price[$index]['after_discount_price'] = intval(str_replace('.','',$item['after_discount_price']));
                    }
                }
            }

            $request->merge(['size_price' => $size_price]);

            // $request['base_price'] = intval(str_replace('.','', $request['base_price']));
            // $request['retail_price'] = intval(str_replace('.','', $request['retail_price']));
            // $request['after_discount_price'] = intval(str_replace('.','', $request['after_discount_price']));
            $validator = $request->validate([
                'product_code' => 'required|unique:products',
                // 'products_image' => 'array|min:1|max:8',
                // 'products_image.*' => 'image|max:2048',
                'products_image.0' => 'required',
                'size_price.0' => 'required',
                'size_price.0.update_size' => 'required',
                'size_price.*.size' => 'required',
                'size_price.*.base_price' => 'required|gte:0',
                'size_price.*.retail_price' => 'required|gte:0',
                'size_price.*.after_discount_price' => 'required|lte:size_price.0.retail_price|gte:0',
                'is_main' => 'required',
                // 'base_price' => 'gte:0',
                // 'retail_price' => 'gte:0',
                // 'after_discount_price' => 'lte:retail_price|gte:0'
            ],[
                'is_main.required' => 'Main image should be chosen!',
                'products_image.0.required' => 'Image must be chosen!, at least one image',
                'size_price.0.required' => 'Product size must be filled, at least one record!',
                'size_price.0.update_size.required' => 'Product Size should be checked at least one size, please consider to checked a size.',
                'size_price.*.size.required' => 'Size must be filled!',
                'size_price.*.base_price.required' => 'Base price must be filled!',
                'size_price.*.base_price.gte' => 'Base price must be not 0',
                'size_price.*.retail_price.required' => 'Retail price must be filled!',
                'size_price.*.retail_price.gte' => 'Retail price must be not 0',
                'size_price.*.after_discount_price.required' => 'After discount price must be filled!',
                'size_price.*.after_discount_price.lte' => 'Discount price must be less than retail price.'
            ]);

            if($validator) {
                $stored = $this->service->insertProduct($request->all());
                if($stored){
                    Alert::success('Product Created Successfully!');
                    return redirect(route('administrator.product.index'))
                        ->with('success', 'Product Created Successfully!');
                } else {
                    Alert::error('Failed to created product, data not matched!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created product, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.product.update');
        $data['product'] = $this->repository->getProductById($id);
        $data['brand'] = $this->brand->getBrandIdAndName();
        $data['product_details'] = $data['product']->details()->selectRaw('id as detail_id , size ,  FORMAT(base_price, 0, "id_ID") AS base_price ,  qty ,  FORMAT(retail_price, 0, "id_ID") AS retail_price ,  FORMAT(after_discount_price, 0, "id_ID") AS after_discount_price ,  discount_percentage, CASE WHEN qty > 0 THEN 1 ELSE 0 END AS update_size')->get()->toJson();
        cleanDirectory('images/upload-buckets');
        return view('product::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $old_data = $this->repository->getProductById($id);
            $data = $request->all();
            // dd($data);
            // $request['base_price'] = intval(str_replace('.','', $request['base_price']));
            // $request['retail_price'] = intval(str_replace('.','', $request['retail_price']));
            // $request['after_discount_price'] = intval(str_replace('.','', $request['after_discount_price']));

            if($old_data->product_code == $data['product_code']){
                $validation = [
                    'product_code' => 'required|exists:products,product_code|max:255',
                    // 'size_price.0' => 'required',
                    // 'size_price.0.update_size' => 'required',
                    'size_price.*.size' => 'required',
                    'size_price.*.base_price' => 'required',
                    'size_price.*.retail_price' => 'required',
                    'size_price.*.after_discount_price' => 'required',
                ];
            } else {
                $validation = [
                    'product_code' => 'required|unique:products,product_code|max:255',
                    // 'size_price.0' => 'required',
                    // 'size_price.0.update_size' => 'required',
                    'size_price.*.size' => 'required',
                    'size_price.*.base_price' => 'required',
                    'size_price.*.retail_price' => 'required',
                    'size_price.*.after_discount_price' => 'required',
                ];
            }

            $validator = $request->validate($validation, [
                'product_code.required' => 'Product Code must be filled!',
                'product_code.exists' => 'Product Code must be exist!',
                'product_code.unique' => 'Product Code must be unique and diffrent from before!',
                'size_price.0.required' => 'Product size must be filled, at least one record!',
                'size_price.0.update_size.required' => 'Product Size should be checked at least one size, please consider to checked a size.',
                'size_price.*.size.required' => 'Size must be filled!',
                'size_price.*.base_price.required' => 'Base price must be filled!',
                'size_price.*.base_price.gte' => 'Base price must be not 0',
                'size_price.*.retail_price.required' => 'Retail price must be filled!',
                'size_price.*.retail_price.gte' => 'Retail price must be not 0',
                'size_price.*.after_discount_price.required' => 'After discount price must be filled!',
                'size_price.*.after_discount_price.lte' => 'Discount price must be less than retail price.',
                'size_price.*.after_discount_price.gte' => 'Discount price must be not below 0.'
            ]);

            if($validator) {
                $updated = $this->service->updateProduct($id ,$request->all());
                if($updated){
                    Alert::success('Product Updated Successfully!');
                    return redirect(route('administrator.product.index'))
                        ->with('success', 'Product Updated Successfully!');
                } else {
                    Alert::error('Failed to updated product, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to updated product, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->repository->deleteProduct($id);

            if($deleted){
                Alert::success('Product Deleted Successfully!');
                return redirect(route('administrator.product.index'))
                    ->with('success', 'Product Deleted Successfully!');
            } else {
                Alert::error('Failed to delete product, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    public function uploadProductFromExcel(Request $request)
    {
        try {
            $stored = $this->service->updateProductbyExcel($request->all());

            if($stored) {
                return response()->json(['code' => 200, 'message' => 'Success update product']);
            }
        } catch (LadminException $e) {
            return response()->json(['code' => 500, 'message' => $e]);
        }
    }

    public function uploadExcelValidation(Request $request)
    {
        try {
            //find bulk article number is exist or not, return data article number where not exist
            $validated = $this->service->validateArticleNumber($request->all());
            if($validated['status'] == 200){
                return response()->json(['code' => 200, 'data' => $validated['data']]);
            } else {
                return response()->json(['code' => 400, 'data' => $validated['data']]);
            }
        } catch (LadminException $e) {
            return response()->json(['code' => 500, 'message' => $e]);
        }
    }

    public function uploadImagetoBuckets(Request $request)
    {
        try {
            $uploadService = $this->service->uploadImagetoBuckets($request->all());

            if(!$uploadService){
                return response()->json(['code' => 500, 'message' => 'Image is Exist']);
            }
            return response()->json(['code' => 200, 'success' => $uploadService]);
        } catch (LadminException $e) {
            return response()->json(['code' => 500, 'message' => $e]);
        }
    }

    public function readFiles(Request $request)
    {
        try {
            $fileInfo = $this->service->readFiles($request->all());

            return response()->json(['code' => 200, 'files' => $fileInfo]);
        } catch (LadminException $e) {
            return response()->json(['code' => 500, 'message' => $e]);
        }
    }

    public function downloadfileTemplate()
    {
        $filepath = public_path('files/template-sneakers.xlsx');
        return Response::download($filepath);
    }
}
