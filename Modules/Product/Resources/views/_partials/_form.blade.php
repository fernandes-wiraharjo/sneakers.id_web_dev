<div class="product-images">
    <input type="hidden" id="is_main" name="is_main" value="{{ $edit ? $main_image : ''}}" />
    <input type="hidden" id="product_details" value="{{ $edit ? $product_details : '' }}" />
    <input type="hidden" id="old_size_price" value="{{ old() != [] ? json_encode(old('size_price')) : '' }}" />
</div>
<x-ladmin-form-group name="product_code" label="Article Number *">
    <input type="text" placeholder="Article Number" class="form-control" name="product_code" id="product_code" required
        value="{{ old('product_code', $product->product_code) ?? $product_code}}">
</x-ladmin-form-group>
<x-ladmin-form-group name="product_name" label="Name *">
    <input type="text" placeholder="Product Name" class="form-control" name="product_name" id="product_name" required
        value="{{ old('product_name', $product->product_name) }}">
</x-ladmin-form-group>
<x-ladmin-form-group name="product_link" label="Link *">
    <input type="text" placeholder="Product Link" class="form-control" name="product_link" id="product_link" required
    value="{{ old('product_link', $product->product_link) }}">
</x-ladmin-form-group>
<x-ladmin-form-group name="brand" label="Brand *">
    <select class="form-control form-select" data-control="select2" name="brand_id" data-placeholder="Select an option">
        <option value=""></option>
        @foreach ($brand as $name => $id)
            <option value="{{$id}}" {{ $edit ? ( old('brand_id', $product->detail->brand_id) == $id ? 'selected' : '' ) : ((old('brand_id') == $id) ? 'selected' : '') }}>
                {{__($name)}}
            </option>
        @endforeach
    </select>
</x-ladmin-form-group>
<hr>
<h3>Product Details</h3>
<br>
<div class="row">
    <h5>Sizes, Quantity & Prices</h5>
    <div class="col-sm-12 m-5">
    <!--begin::Repeater-->
    <div id="size_price">
        <!--begin::Form group-->
        <!--begin::Form update bulk-->
        {{-- <div class="form-group">
            <x-ladmin-form-group name="size_product_filter" label="Product Sizes Filter">
                @livewire('size', ['edit' => $edit ])
            </x-ladmin-form-group>
        </div> --}}
        <!--begin::Form update bulk-->
        <!--begin::Form update bulk-->
        {{-- <div class="form-group"> --}}
        <div class="card shadow-sm card-bordered">
            <div class="card-header">
                <h3 class="card-title">Bulk Update by Selection</h3>
                <div class="card-toolbar">
                    <a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8" onclick="updateAll(this)">
                        Update
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-1 form-check"  style="align-self: center !important;">
                        <input class="form-check-input" type="checkbox" value="" id="bulk_update_size" onchange='bulkChecked(this);'/>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="form-label">Base Price :</label>
                                <div class="input-group mb-5">
                                    <span class="input-group-text">Rp</span>
                                    <input id="base" type="text" class="form-control bulk-base-price" name="bulk_base_price" min=1
                                    value="" aria-label="Amount (to the nearest rupiah)"/>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Quantity :</label>
                                <div class="input-group mb-5">
                                    <input type="number" id="qty" min="0" class="form-control bulk-qty" name="bulk_qty" aria-label="Amount"
                                    value=""/>
                                    <span class="input-group-text"> pcs</span>
                                </div>
                            </div>
                            {{-- <div class="col-md-2">
                                <a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8" onclick="updateAll(this)">
                                    Update
                                </a>
                            </div> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="form-label">Retail Price :</label>
                                <div class="input-group mb-5">
                                    <span class="input-group-text">Rp</span>
                                    <input id="base" type="text" class="form-control bulk-retail-price" name="bulk_retail_price" min=1
                                    value="" aria-label="Amount (to the nearest rupiah)"/>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">After Discount Price:</label>
                                <div class="input-group mb-5">
                                    <span class="input-group-text">Rp</span>
                                    <input id="discount" type="text" class="form-control bulk-after-discount-price" name="bulk_discount_price" min="0"
                                    value="" aria-label="Amount (to the nearest rupiah)"/>
                                    <span class="input-group-text">%</span>
                                    <input type="number" class="form-control bulk-discount-percentage" name="bulk_discount_percentage" min="0" max="100"
                                        value=""
                                    placeholder="Percentage" aria-label="Percent"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
        <!--end::Form update bulk-->
        <hr>
        <div class="form-group">
            <div data-repeater-list="size_price">
                <div data-repeater-item>
                    <div class="form-group row repeater-form">
                        <div class="col-1 form-check"  style="align-self: center !important;">
                            <input class="form-check-input select-update-size" type="checkbox" name="update-size" value="" id="update_size"/>
                            <input style="display: none;" type="text" id="id" name="detail_id" value="" />
                        </div>
                        <div class="col-11">
                            <div class="form-group row">
                                <div class="col-4">
                                    <label class="form-label">Size :</label>
                                    <input id="size" type="text" class="form-control" name="size"
                                        value="{{ old('size_prize.0.base_price', '') }}" aria-label="Product Sizes"/>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Base Price :</label>
                                    <div class="input-group mb-5">
                                        <span class="input-group-text">Rp</span>
                                        <input id="base" type="text" class="form-control base-price" name="base_price" min=1
                                        value="{{ old('size_prize.0.base_price', '') }}" aria-label="Amount (to the nearest rupiah)"/>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">Quantity :</label>
                                    <div class="input-group mb-5">
                                        <input type="text" id="qty" class="form-control qty" name="qty" aria-label="Amount"
                                        value="{{ old('size_prize[0][qty]', '') }}"/>
                                        <span class="input-group-text"> pcs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-label">Retail Price:</label>
                                    <div class="input-group mb-5">
                                        <span class="input-group-text">Rp</span>
                                        <input id="retail" type="text" class="form-control retail-price" name="retail_price" min="0"
                                        value="{{ old('size_prize[0][retail_price]', '') }}" aria-label="Amount (to the nearest rupiah)"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">After Discount Price:</label>
                                    <div class="input-group mb-5">
                                        <span class="input-group-text">Rp</span>
                                        <input id="discount" type="text" class="form-control after-discount-price" name="after_discount_price" min="0"
                                        value="{{ old('size_prize[0][after_discount_price]', '') }}" aria-label="Amount (to the nearest rupiah)"/>
                                        <span class="input-group-text">%</span>
                                        <input type="text" class="form-control discount-percentage" name="discount_percentage" min="0" max="100"
                                            value="{{ old('size_prize[0][discount_percentage]', '') }}"
                                        placeholder="Percentage" aria-label="Percent"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="fas fa-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <!--end::Form group-->

        <!--begin::Form group-->
        <div class="form-group mt-5">
            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                <i class="fas fa-plus fs-3"></i>
                Add
            </a>
        </div>
        <!--end::Form group-->
    </div>
<!--end::Repeater-->

</div>
    <hr>
    <div class="col-sm-6">
        <h5>Product Description*</h5>
        <br>
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Input-->
            <textarea name="description" id="kt_docs_tinymce_basic" class="tox-target">
                {!! old('description', $product->description) !!}
            </textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <h5>Product Variant</h5>
        <br>
        <x-ladmin-form-group name="categories" label="Category">
            @livewire('category', [
                'current_category' => $product->categories()
                    ->select('category_id as id', 'category_title as value')
                    ->get(),
                'edit' => $edit ])
        </x-ladmin-form-group>
        <x-ladmin-form-group name="tags" label="Tag">
            @livewire('tag', [
                'current_tag' => $product->tags()
                    ->select('tag_id as id', 'tag_title as value')
                    ->get(),
                'edit' => $edit ])
        </x-ladmin-form-group>
        <x-ladmin-form-group name="models" label="Signature Player">
            @livewire('signature-player', [
                'current_signature' => $product->signatures()
                    ->select(
                        'signature_player_id as value',
                        'signature_code as code',
                        'signature_player_name as title'
                    )->get(),
                'edit' => $edit ])
        </x-ladmin-form-group>
    </div>
</div>
<hr>


@include('components.is_active', ['is_active' => $product->is_active, 'edit' => $edit])
@push('top-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
@push('scripts')
    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script src="{{asset('demo1/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script src="{{asset('demo1/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
    <script>
        var options = {selector: "#kt_docs_tinymce_basic"};

        tinymce.init(options);
    </script>
    <script>
        const form = document.getElementById('form');

        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'product_code': {
                        validators: {
                            notEmpty: {
                                message: 'Code is required'
                            },
                            regexp: {
                                regexp : /^(\d|\w|-)+$/,
                                message : "Code should'nt contain spaces"
                            }
                        }
                    },
                    'product_link': {
                        validators: {
                            notEmpty: {
                                message: 'Product Link is required'
                            },
                            uri: {
                                message : "Product link not valid"
                            }
                        }
                    },
                    'product_name': {
                        validators: {
                            notEmpty: {
                                message: 'Product name is required'
                            }
                        }
                    },
                    'brand_id': {
                        validators: {
                            notEmpty: {
                                message: 'Brand must be selected'
                            }
                        }
                    },
                    'category': {
                        validators: {
                            notEmpty: {
                                message: 'Category is required'
                            }
                        }
                    },
                    'description': {
                        validators: {
                            callback: {
                                message: 'The comment must be more than 5 characters long',
                                callback: function (value) {
                                    // Get the plain text without HTML
                                    const text = tinyMCE.activeEditor.getContent({
                                        format: 'text',
                                    });

                                    return text.length >= 5;
                                },
                            },
                        },
                    },
                    '' : {},
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        $(form.querySelector('[name="brand_id"]')).on('change', function () {
            validator.revalidateField('brand_id');
        });

        $(form.querySelector('[name="description"]')).on('change', function () {
            validator.revalidateField('description');
        });

        // Submit button handler
        const submitButton = document.getElementById('form-submit');
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        setTimeout(function () {
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;

                            form.submit(); // Submit form
                        }, 2000);
                    }
                });
            }
        });
    </script>
    <script>
        var base = document.getElementsByClassName("base-price");
        var retail = document.getElementsByClassName("retail-price");
        var after_discount = document.getElementsByClassName("after-discount-price");
        var bulkBase = document.getElementsByClassName("bulk-base-price");
        var bulkRetail = document.getElementsByClassName("bulk-retail-price");
        var bulkAfterDiscount = document.getElementsByClassName("bulk-after-discount-price");

        // base = [].slice.call(base, 0);
        for (var i = 0; i < base.length; ++i){
            base[i].addEventListener("keyup", function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        for (var i = 0; i < retail.length; ++i){
            retail[i].addEventListener("keyup", function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        for (var i = 0; i < after_discount.length; ++i){
            after_discount[i].addEventListener("keyup", function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        for (var i = 0; i < bulkBase.length; ++i){
            bulkBase[i].addEventListener("keyup", function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        for (var i = 0; i < bulkRetail.length; ++i){
            bulkRetail[i].addEventListener("keyup", function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        for (var i = 0; i < bulkAfterDiscount.length; ++i){
            bulkAfterDiscount[i].addEventListener("keyup", function(e) {
                this.value = formatRupiah(this.value);
            });
        }

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? rupiah : "";
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.main-image').click(function() {
                checked = $(".main-image:checkbox:checked").length;

                if(checked > 1) {
                    $(".main-image:checkbox:checked").prop('checked', false);
                    $(this).prop('checked', true);
                }
            });
        });

        function bulkChecked(checkbox) {
            if(checkbox.checked == true){
                $(".select-update-size").each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $(".select-update-size").each(function(){

                    $(this).prop('checked', false);
                });

            }
        }

        function updateAll(button) {
            $(".repeater-form").each(function(){
                isChecked = $(this).find(".select-update-size").is(':checked')
                if(isChecked){
                    if($('.bulk-base-price').val() != "") {
                        $(this).find('.base-price').val($('.bulk-base-price').val());
                    }

                    if($('.bulk-qty').val() != "") {
                        $(this).find('.qty').val($('.bulk-qty').val());
                    }

                    if($('.bulk-retail-price').val() != ""){
                        $(this).find('.retail-price').val($('.bulk-retail-price').val());
                    }

                    if($('.bulk-after-discount-price').val() != ""){
                        $(this).find('.after-discount-price').val($('.bulk-after-discount-price').val());
                    }

                    if($('.bulk-discount-percentage').val() != ""){
                        $(this).find('.discount-percentage').val($('.bulk-discount-percentage').val());
                    }
                }
            });
        }

    </script>

    <script>
        var repeater = $('#size_price').repeater({
            initEmpty: false,

            defaultValues: {
                'base_price': '1',
                'retail_price': '1',
                'discount_price': '0',
            },

            show: function () {
                $(this).slideDown();

                var base = document.getElementsByClassName("base-price");
                var retail = document.getElementsByClassName("retail-price");
                var after_discount = document.getElementsByClassName("after-discount-price");
                for (var i = 0; i < base.length; ++i){
                    base[i].addEventListener("keyup", function(e) {
                        this.value = formatRupiah(this.value);
                    });
                }

                for (var i = 0; i < retail.length; ++i){
                    retail[i].addEventListener("keyup", function(e) {
                        this.value = formatRupiah(this.value);
                    });
                }

                for (var i = 0; i < after_discount.length; ++i){
                    after_discount[i].addEventListener("keyup", function(e) {
                        this.value = formatRupiah(this.value);
                    });
                }
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {

            }
        });

        @if(old() != [])
            repeater.setList(JSON.parse($('#old_size_price').val()));
        @endif

        @if($edit)
            repeater.setList(JSON.parse($('#product_details').val()));
        @endif
    </script>
@endpush
