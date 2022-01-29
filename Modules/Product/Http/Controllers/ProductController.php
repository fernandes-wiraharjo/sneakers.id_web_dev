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
        $this->service->insertProduct($request->all());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
