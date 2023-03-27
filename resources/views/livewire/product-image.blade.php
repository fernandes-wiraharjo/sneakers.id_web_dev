<div id="image-upload">
    @for ($i = 0; $i < 8; $i++)
    <!--begin::Image input-->
    <div class="image-input {{ $edit ? (!empty($image[$i]) ? '' : 'image-input-empty') : 'image-input-empty' }} image-input-outline" data-kt-image-input="true"
        style="background-image: url({{ asset('demo1/media/blank/blank-image.png') }}); background-position: center; margin-right: 20px; margin-bottom: 20px">
        <!--begin::Image preview wrapper-->
        <div class="image-input-wrapper w-125px h-125px" id="image-input-warpper-{{$i}}"
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

        @if($i < 1)
        <!--begin::Edit button-->
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow {{ $edit ? (!empty($image[$i]) ? 'd-none' : '') : '' }}"
        id="image-upload-{{$i}}"
        data-kt-image-input-action="change"
        data-bs-toggle="tooltip"
        data-bs-dismiss="click"
        title="Change image">
            <i class="bi bi-pencil-fill fs-7"></i>

            <input class="files" id="{{$i}}" type="file" onchange="imagesSelected" name="products_image[]" accept=".png, .jpg, .jpeg" multiple/>
        </label>
        <!--end::Edit button-->
        @endif

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
@push('top-scripts')
    <script>
        $('.files').on("change", async (event) => {
            var totalfiles = document.getElementById(0).files.length;
            console.log(totalfiles)

            let files = [...event.target.files];

		    let images = await Promise.all(files.map(f=>{
                return readAsDataURL(f)
            }));

            if(totalfiles > 0 ){
                // Read selected files
                for (var index = 0; index < totalfiles; index++) {
                    var div = document.getElementById('image-input-warpper-'+index);
                    div.style.backgroundImage = 'url(' + images[index].data + ')';
                }
            }
        })

        async function imagesSelected(event) {
		    let files = [...event.target.files];

		    let images = await Promise.all(files.map(f=>{
                console.log(files)
                return readAsDataURL(f)
            }));
            //all images' base64encoded data will be available as array in images
        }

        function readAsDataURL(file) {
                return new Promise((resolve, reject)=>{
                    let fileReader = new FileReader();
                    fileReader.onload = function(){
                        return resolve({data:fileReader.result, name:file.name, size: file.size, type: file.type});
                    }
                    fileReader.readAsDataURL(file);
                })
        }
    </script>
@endpush
</div>



