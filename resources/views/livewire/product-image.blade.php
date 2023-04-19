<div id="image-upload">
    <div class="row align-middle" style="align-items: center">
        <div class="col-3">
            <label for="">Thumbnail</label>
            <div class="d-flex flex-center h-150px">
                <img
                    src="{{ asset('demo1/media/blank/blank-image.png') }}"
                    class="thumbnail rounded h-12"
                    style="height: inherit;"
                    alt=""
                />
            </div>
        </div>
        <div class="col-9">
            <label for="">Drop files here or click to upload. Click image to select main image / thumbnail</label>
            <!--begin::Form-->
            <form class="form" action="#" enctype="multipart/form-data" method="post">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Dropzone-->
                    <div class="dropzone" id="kt_dropzonejs_example_1">
                        <!--begin::Message-->
                        <div class="dz-message needsclick">
                            <i class="fas fa-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                            <!--begin::Info-->
                            <div class="ms-4">
                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                <span class="fs-7 fw-semibold text-gray-400">Upload up to 8 files</span>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Dropzone-->
                </div>
                <!--end::Input group-->
            </form>
            <!--end::Form-->
        </div>
    </div>
{{-- <input type="hidden" name="remove_image[]" /> --}}
{{-- <input type="hidden" name="before_image[]" value="{{!empty($image[$i]) ? $image[$i]['image_url'] : ''}}" /> --}}
</div>
@push('styles')
<style>
    .dropzone .dz-preview .dz-image img{
        width: inherit;
        height: inherit;
    }
</style>
@endpush
@push('scripts')
    <script>
        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: "{{ route('administrator.product.upload') }}", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 8,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                if (response.code === 200) {
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    }
                    $('.product-images').append('<input type="hidden" name="products_image[]" value="' + response.success + '">')
                    file.previewElement.id = response.success;
                    $('#is_main').val(response.success);
                    $('.thumbnail').attr('src', '{{ asset("images/upload-buckets/") }}'+'/'+response.success);
                    // set new images names in dropzone’s preview box.
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                } else {
                    var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
				    return _results;
                }
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                     name = file.file_name
                 } //else {
                //     name = uploadedDocumentMap[file.name]
                // }
                // $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                @if($edit)
                $('.product-images').append('<input type="hidden" name="remove_image[]" value="' + file.name + '">')
                @else
                $('.product-images').append('<input type="hidden" name="remove_image[]" value="' + name + '">')
                @endif

                if($('#is_main').val() === file.name){
                    $('.thumbnail').attr('src', '{{ asset("demo1/media/blank/blank-image.png") }}');
                }
            },
            init: function () {
                @if($edit)
                    var main_image = $('#is_main').val();
                    var product_code = $('#product_code').val();
                    $('.thumbnail').attr('src', '{{ asset("images/products") }}'+'/'+product_code+'/'+main_image);

                    data = {
                        'product_code' : product_code
                    }
                    myDropzone = this;

                    $.ajax({
                    url: '{{ route("administrator.product.readfiles") }}',
                    type: 'get',
                    data: data,
                    dataType: 'json',
                    success: function(response){

                        $.each(response.files, function(key,value) {
                            var mockFile = { name: value.name, size: value.size };

                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, value.path);
                            myDropzone.emit("complete", mockFile);

                            // console.log(myDropzone.options.thumbnailWidth )
                        });

                    }
                    });
                @endif
            }
        });

        myDropzone.on("addedfile", function(file) {
            file.previewElement.addEventListener("click", function() {
                @if($edit)
                    if(file.name.includes("0_")) {
                        $('.thumbnail').attr('src', '{{ asset("images/".$module) }}'+'/'+file.name);
                        $('#is_main').val(file.name);
                    } else {
                        $('.thumbnail').attr('src', '{{ asset("images/upload-buckets/") }}'+'/0_'+file.name);
                        $('#is_main').val('0_'+file.name);
                    }
                @else
                    files = file.name.split('.')
                    $('.thumbnail').attr('src', '{{ asset("images/upload-buckets/") }}'+'/0_'+files[0]+'_1800x1800.'+files[1]);
                    $('#is_main').val('0_'+files[0]+'_1800x1800.'+files[1]);
                @endif
            });
        });
    </script>
@endpush
