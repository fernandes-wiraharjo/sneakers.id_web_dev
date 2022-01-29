<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Entities\CategoryDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Category\Entities\Category;

class ApiCategoryController extends Controller
{

    protected $repository;

    public function __construct(CategoryRepository $repository) {
        $this->repository = $repository;
    }

    public function index(){
        try {
            $data = $this->repository->getCategoryIdAndNameLivewire();
            return response([
                'success' => true,
                'message' => 'list all category',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'success' => false,
                'message' => 'Failed get category',
                'data' => []
            ], 200);
        }
    }
}
