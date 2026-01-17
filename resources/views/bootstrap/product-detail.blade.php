@extends('bootstrap.layout')

@section('title', $product->product_name)
@section('description', strip_tags($product->description))

@section('content')
    <!-- product detail -->
    @livewire('product', ['product' => $product,  'sizeList' => $size, 'size_chart_image' => $size_chart_image ?? '', 'reviews' => $reviews])

    <!-- related product -->
    @livewire('related-product', ['product' => $product])
@endsection
