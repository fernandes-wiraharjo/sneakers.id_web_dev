<?php

namespace Modules\ExternalReview\Http\Controllers;

use Alert;
use Hexters\Ladmin\Exceptions\LadminException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ExternalReview\Entities\ExternalReviewDatatables;
use Modules\ExternalReview\Entities\ExternalReviewLink;
use Modules\ExternalReview\Repositories\ExternalReviewRepository;
use Modules\Product\Entities\ProductDetail;

class ExternalReviewController extends Controller
{
    protected $repository;

    public function __construct(ExternalReviewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(ExternalReviewDatatables $dataTables)
    {
        ladmin()->allow('administrator.external-review.index');

        return $dataTables->render('externalreview::index');
    }

    public function create()
    {
        ladmin()->allow('administrator.external-review.create');

        $data['link'] = new ExternalReviewLink();
        $data['products'] = $this->repository->getActiveProductsForSelect();

        return view('externalreview::create', $data);
    }

    public function store(Request $request)
    {
        ladmin()->allow('administrator.external-review.create');

        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'product_size' => 'required|string|max:255',
                'buyer_name' => 'required|string|max:255',
            ]);

            $sizeExists = ProductDetail::query()
                ->where('product_id', $validated['product_id'])
                ->where('size', $validated['product_size'])
                ->exists();

            if (! $sizeExists) {
                Alert::error('Selected size is not valid for this product.');

                return redirect()->back()->withInput();
            }

            $link = $this->repository->createLink([
                'product_id' => $validated['product_id'],
                'product_size' => $validated['product_size'],
                'buyer_name' => $validated['buyer_name'],
                'created_by' => auth()->id(),
            ]);

            Alert::success('Review link created successfully!');

            return redirect(route('administrator.external-review.index'))
                ->with('success', 'Review link created successfully!')
                ->with('generated_link', $link->review_url);
        } catch (LadminException $e) {
            Alert::error($e->getMessage());

            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        ladmin()->allow('administrator.external-review.destroy');

        try {
            $deleted = $this->repository->deleteLink($id);

            if ($deleted) {
                Alert::success('Review link deleted successfully!');

                return redirect(route('administrator.external-review.index'))
                    ->with('success', 'Review link deleted successfully!');
            }

            Alert::error('Cannot delete a link that has already been used.');

            return redirect()->back();
        } catch (LadminException $e) {
            Alert::error($e->getMessage());

            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function productSizes($productId)
    {
        ladmin()->allow('administrator.external-review.create');

        return response()->json([
            'sizes' => $this->repository->getProductSizes((int) $productId),
        ]);
    }
}
