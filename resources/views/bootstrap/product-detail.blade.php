@extends('bootstrap.layout')

@section('title', $product->product_name)
@section('description', strip_tags($product->description))

@section('content')
    @livewire('product', ['product' => $product,  'sizeList' => $size])
@endsection
