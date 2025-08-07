<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Product\Entities\Product;
use Modules\Product\Repositories\ProductRepository;

class DeleteOldProducts extends Command
{
    protected $signature = 'product:delete-old
                            {--limit=0 : Number of last products to delete}
                            {--dry-run : Preview the products without deleting}';

    protected $description = 'Delete last N products with all related data and images';

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function handle()
    {
        $limit = (int) $this->option('limit');
        $dryRun = $this->option('dry-run');

        if ($limit <= 0) {
            $this->error('Please specify a valid limit using --limit=N');
            return 1;
        }

        // Get oldest products
        $products = Product::orderBy('updated_at', 'asc')
            ->take($limit)
            ->get();

        if ($dryRun) {
            $this->info('Dry run enabled. The following products would be deleted:');
            $this->table(['ID', 'Product Code', 'Name', 'Updated At'], $products->map(function ($p) {
                return [$p->id, $p->product_code, $p->product_name, $p->updated_at];
            })->toArray());
            return 0;
        }

        foreach ($products as $product) {
            $this->info("Deleting product ID {$product->id} ({$product->product_name})...");
            $this->repository->deleteProduct($product->id, 'command');
        }

        $this->info("Deleted {$limit} product(s) successfully.");
        return 0;
    }
}
