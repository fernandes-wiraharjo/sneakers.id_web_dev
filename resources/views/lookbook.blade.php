<x-base-front-layout>
    <div class="m-20">
        <!--begin::Wrapper-->
        <div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9">
            @foreach ($lookbook as $item)
                <!--begin::Card-->
                <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100" id="imageresource{{$item->id}}">
                        <a class="pop" href="#" data-id="{{$item->id}}">
                        <!--begin::Body-->
                        <div class="card-body text-center">
                            <!--begin::Food img-->
                            <img src="{{ getImage($item->look_book_image, 'lookbook')}}" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" alt="{{$item->look_book_title}}">
                            <!--end::Food img-->
                            <!--begin::Info-->
                            <div class="mb-2">
                                <!--begin::Title-->
                                <div class="text-center">
                                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{$item->look_book_title}}</span>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Body-->
                    </a>
                </div>
                <!--end::Card-->
            @endforeach
        </div>
        <!--end::Wrapper-->

        <div class="pagination-section">
            {{$lookbook->links()}}
        </div>
    </div>
</x-base-front-layout>
