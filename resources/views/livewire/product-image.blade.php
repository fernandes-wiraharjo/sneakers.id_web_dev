<div id="image-upload">
    @for ($i = 0; $i < 8; $i++)
    <!--begin::Image input-->
    <div class="image-input {{ $edit ? (!empty($image[$i]) ? '' : 'image-input-empty') : 'image-input-empty' }} image-input-outline" data-kt-image-input="true"
        style="background-image: url({{ asset('demo1/media/blank/blank-image.png') }}); background-position: center; margin-right: 20px; margin-bottom: 20px">
        <!--begin::Image preview wrapper-->
        <div class="image-input-wrapper w-125px h-125px"
            @if($edit)
                style="background-image: url({!! !empty($image[$i]) ? getImage($image[$i]['image_url'], $module) : '' !!});"
            @endif>
        </div>
            <!--end::Image preview wrapper-->
        <!--begin::Inputs-->

        {{-- <input type="hidden" name="{{ $module }}_image[]" /> --}}
        <input type="hidden" name="remove_image[]" />
        <input type="hidden" name="before_image[]" value="{{!empty($image[$i]) ? $image[$i]['image_url'] : ''}}" />
        <!--end::Inputs-->

        <!--begin::Edit button-->
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow {{ $edit ? (!empty($image[$i]) ? 'd-none' : '') : '' }}"
        id="image-upload-{{$i}}"
        data-kt-image-input-action="change"
        data-bs-toggle="tooltip"
        data-bs-dismiss="click"
        title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>

            <input type="file" name="products_image[]" accept=".png, .jpg, .jpeg" />
        </label>
        <!--end::Edit button-->

        <!--begin::Cancel button-->
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="cancel"
        data-bs-toggle="tooltip"
        data-bs-dismiss="click"
        title="Cancel image">
            <i class="bi bi-x fs-2"></i>
        </span>
        <!--end::Cancel button-->

        <!--begin::Remove button-->
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow remove-{{$i}}"
        data-id="{{$i}}"
        data-kt-image-input-action="remove"
        data-bs-toggle="tooltip"
        data-bs-dismiss="click"
        title="Remove image">
            <i class="bi bi-x fs-2"></i>
        </span>
        <!--end::Remove button-->

        <span class="form-check form-check-custom form-check-solid form-check-sm m-2">
                <input class="form-check-input main-image" type="checkbox" value="1" name="is_main[{{$i}}]" id="mainImage{{$i}}"
                    {{ $main_image ? ($main_image == (!empty($image[$i]) ? $image[$i]['image_url'] : '') ? 'checked' : '') : '' }} />
                <label class="form-check-label" for="mainImage{{$i}}">
                    Main image
                </label>
        </span>
    </div>
<!--end::Image input-->
@push('scripts')
    <script>
        $('.remove-{{ $i }}').click(function () {
            var data = $(this).attr('data-id');
            $('#image-upload-'+data).removeClass('d-none');
        })
    </script>
@endpush
@endfor
</div>



