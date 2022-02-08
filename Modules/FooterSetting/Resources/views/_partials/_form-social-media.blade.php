<div id="social_media">

    <!--begin::Form group-->
    <div data-repeater-list="social_media">
        @if(!empty($social_media))
        @foreach ($social_media as $item)
            <div data-repeater-item>
                <div class="form-group row mb-5">
                    <div class="col-md-2">
                        <label class="form-label">Social Icon :</label>
                        @include('components.social-selector', ['selected' => $item->social_icon])
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Social Name :</label>
                        <input type="text" class="form-control mb-2 mb-md-0" name="social_name" placeholder="Enter social media name"
                        value="{{ old('social_name', $item->social_name) }}"/>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Social Link :</label>
                        <input type="text" class="form-control mb-2 mb-md-0" name="social_link"  placeholder="Enter social media link"
                        value="{{ old('social_link',$item->social_link) }}"/>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                            <i class="la la-trash-o"></i>Delete
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div data-repeater-item>
            <div class="form-group row mb-5">
                <div class="col-md-2">
                    <label class="form-label">Social Icon :</label>
                    @include('components.social-selector')
                </div>
                <div class="col-md-3">
                    <label class="form-label">Social Name :</label>
                    <input type="text" class="form-control mb-2 mb-md-0" name="social_name" placeholder="Enter social media name" />
                </div>
                <div class="col-md-5">
                    <label class="form-label">Social Link :</label>
                    <input type="text" class="form-control mb-2 mb-md-0" name="social_link"  placeholder="Enter social media link" />
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                        <i class="la la-trash-o"></i>Delete
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="la la-plus"></i>Add
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->
@push('scripts')
<script src="{{ asset('demo1/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script>
    $('#social_media').repeater({
    initEmpty: false,

    show: function () {
        $(this).slideDown();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
</script>
@endpush
