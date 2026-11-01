<?php

/**
 * One-off: clone existing products so local pagination can be tested.
 * Usage: php scripts/duplicate-products-for-pagination-test.php [copies_per_product]
 * Cleanup: php scripts/duplicate-products-for-pagination-test.php --cleanup
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Product\Entities\Product;

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$args = array_slice($argv, 1);
$cleanup = in_array('--cleanup', $args, true);
$copies = 20;

foreach ($args as $arg) {
    if (ctype_digit($arg)) {
        $copies = (int) $arg;
    }
}

if ($cleanup) {
    $deleted = Product::where('product_code', 'like', 'PAGETEST-%')->delete();
    echo "Deleted {$deleted} PAGETEST products (cascades depend on DB FKs)." . PHP_EOL;

    // Clean orphaned children if no cascade
    DB::table('product_details')->whereNotIn('product_id', Product::pluck('id'))->delete();
    DB::table('product_images')->whereNotIn('product_id', Product::pluck('id'))->delete();
    DB::table('product_tags')->whereNotIn('product_id', Product::pluck('id'))->delete();
    DB::table('product_sizes')->whereNotIn('product_id', Product::pluck('id'))->delete();
    DB::table('product_categories')->whereNotIn('product_id', Product::pluck('id'))->delete();
    DB::table('product_signature')->whereNotIn('product_id', Product::pluck('id'))->delete();
    if (Schema::hasTable('product_size_charts')) {
        DB::table('product_size_charts')->whereNotIn('product_id', Product::pluck('id'))->delete();
    }

    echo 'Remaining products: ' . Product::count() . PHP_EOL;
    exit(0);
}

$sources = Product::with(['details', 'images', 'tags', 'sizes', 'categories', 'signatures', 'sizeCharts'])
    ->where('product_code', 'not like', 'PAGETEST-%')
    ->where('is_active', 1)
    ->get();

if ($sources->isEmpty()) {
    echo "No source products found." . PHP_EOL;
    exit(1);
}

$created = 0;
$stamp = time();

DB::beginTransaction();
try {
    foreach ($sources as $source) {
        for ($i = 1; $i <= $copies; $i++) {
            $code = 'PAGETEST-' . $stamp . '-' . $source->id . '-' . $i;

            $clone = $source->replicate(['id']);
            $clone->product_code = $code;
            $clone->product_name = '[PAGETEST] ' . $source->product_name . ' #' . $i;
            $clone->product_link = trim(($source->product_link ?: 'product') . '-pagetest-' . $stamp . '-' . $i, '-');
            $clone->created_at = now();
            $clone->updated_at = now();
            $clone->save();

            foreach ($source->details as $detail) {
                $d = $detail->replicate(['id']);
                $d->product_id = $clone->id;
                $d->save();
            }

            foreach ($source->images as $image) {
                $img = $image->replicate(['id']);
                $img->product_id = $clone->id;
                $img->save();
            }

            foreach ($source->sizeCharts as $chart) {
                $c = $chart->replicate(['id']);
                $c->product_id = $clone->id;
                $c->save();
            }

            $clone->tags()->sync($source->tags->pluck('id')->all());
            $clone->sizes()->sync($source->sizes->pluck('id')->all());
            $clone->categories()->sync($source->categories->pluck('id')->all());
            $clone->signatures()->sync($source->signatures->pluck('id')->all());

            $created++;
        }
    }
    DB::commit();
} catch (Throwable $e) {
    DB::rollBack();
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
    exit(1);
}

echo "Created {$created} PAGETEST products from {$sources->count()} sources ({$copies} each)." . PHP_EOL;
echo 'Total products now: ' . Product::count() . PHP_EOL;
echo 'Cleanup later: php scripts/duplicate-products-for-pagination-test.php --cleanup' . PHP_EOL;
