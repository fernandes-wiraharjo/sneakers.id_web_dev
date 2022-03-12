<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Entities\ProductDatatables;
use Modules\Brand\Repositories\BrandRepository;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductDetail;
use App\Services\ProductService;
use Alert;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $repository;
    private $brandRepository;
    private $productService;

    public function __construct(ProductRepository $repository, BrandRepository $brandRepository, ProductService $productService) {
        $this->repository = $repository;
        $this->brand = $brandRepository;
        $this->service = $productService;
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
            $request['base_price'] = intval(str_replace('.','', $request['base_price']));
            $request['retail_price'] = intval(str_replace('.','', $request['retail_price']));
            $request['after_discount_price'] = intval(str_replace('.','', $request['after_discount_price']));

            $validator = $request->validate([
                'product_code' => 'required|unique:products',
                'products_image' => 'array|min:1|max:5',
                'products_image.*' => 'image|max:2048',
                'products_image.0' => 'required',
                'is_main' => 'required',
                'base_price' => 'gte:1',
                'retail_price' => 'gte:1'
            ],[
                'is_main.required' => 'Main image should be chosen!',
                'products_image.0.required' => 'Image must be chosen!, at least one image'
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

            if($old_data->product_code == $data['product_code']){
                $validation = [
                    'product_code' => 'required|exists:products,product_code|max:255',
                ];
            } else {
                $validation = [
                    'product_code' => 'required|unique:products,product_code|max:255',
                ];
            }

            $validator = $request->validate($validation);

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
}
