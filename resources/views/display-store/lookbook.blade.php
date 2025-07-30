@extends('display-store.store-theme._base')

@section('title', 'LOOKBOOK')

@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/lookbook.css') }}" />
@endpush

@section('body')
    <div class="content">
        <section id="pinBoot">
            @foreach ($lookbook as $item)
                    <article class="white-panel">
                        <p>
                            <span>
                                {{$item->look_book_title}}
                            </span>
                        </p>
                        <a  class="pop" href="#" data-id="{{$item->id}}">
                            <img id="imageresource{{$item->id}}" src="{{ getImage($item->look_book_image, 'lookbook')}}" alt="{{$item->look_book_title}}">
                        </a>
                    </article>
            @endforeach

        </section>
        <div class="pagination-section">
            {{$lookbook->links()}}
        </div>
    </div>

    @foreach ($lookbook as $item)
    <!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </a>
                    <img src="" id="imagepreview{{$item->id}}">
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/lookbook.js') }}" defer></script>
@endpush
