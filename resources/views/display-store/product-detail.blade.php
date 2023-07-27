@extends('display-store.store-theme._base')

@section('title', $product->product_name)
@section('description', strip_tags($product->description))

@push('styles')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/product-detail.css') }}" />
<style>
    .Button--selected{
        color: black;
    }
    .Button--selected::before {
        background-color: white !important;
    }

    .size-select,
    .size-select::before,
    .size-select::after {
        box-sizing: border-box;
    }

    .size-select {
        min-width: 15ch;
        max-width: 30ch;
        border: 1px solid var(--select-border);
        padding: 0.25em 0.5em;
        font-size: 15px;
        font-weight: 400;
        font-style: normal;
        cursor: pointer;
        line-height: 1.1;
        color: rgb(0, 0, 0);
        background-color: rgb(255, 254, 254);
    }

    select:focus + .focus {
        position: absolute;
        top: -1px;
        left: -1px;
        right: -1px;
        bottom: -1px;
        border: 2px solid var(--select-focus);
        border-radius: inherit;
        }
</style>


@endpush

@section('body')
   @livewire('product', ['product' => $product,  'sizeList' => $size])
@endsection

@push('scripts')
    <script>
        var product_variants_removed = [];

        // $(".pop").on("click", function(e) {
        //     e.preventDefault();
        //     // $('#imagemodal').attr('src', $('#imageresource'+id).attr('src')); // here asign the image to the modal when the user click the enlarge link
        //     $('#sizeModal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        // });

        $(document).ready(function() {
            $('#size').change(function() {
                $('#retail').text($(this).find(':selected').attr('data-price'));
                $('#discount').text($(this).find(':selected').attr('data-discount-price'));
                $('#percentage').text($(this).find(':selected').attr('data-discount'));;
            });
        });

        // $(document).ready(function() {
        //     $('#size').change(function(e) {
        //         e.preventDefault();
        //         console.log('retail', $(this).find(':selected').attr('data-price'));
        //         console.log('discount', $(this).find(':selected').attr('data-discount-price'));
        //         console.log('percentage', $(this).find(':selected').attr('data-discount'));
        //         $('#retail').text($(this).find(':selected').attr('data-price'));
        //         $('#discount').text($(this).find(':selected').attr('data-discount-price'));
        //         $('#percentage').text($(this).find(':selected').attr('data-discount'));
        //     });
        // });
    </script>
@endpush
