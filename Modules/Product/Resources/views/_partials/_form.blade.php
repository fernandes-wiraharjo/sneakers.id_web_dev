<div class="mr-5 ml-5 mt-3 p-2 mb-2 text-center">
    @livewire('product-image', ['image' => $product->images()->get('image_url')->toArray(),'module' => 'product', 'edit' => $edit])
</div>
<hr>
<x-ladmin-form-group name="product_code" label="Code *">
    <input type="text" placeholder="Product Code" class="form-control" name="product_code" id="product_code" required
        value="{{ $product_code }}" readonly>
</x-ladmin-form-group>
<x-ladmin-form-group name="product_name" label="Name *">
    <input type="text" placeholder="Product Name" class="form-control" name="product_name" id="product_name" required
        value="{{ old('product_name', $product->product_name) }}">
</x-ladmin-form-group>
<x-ladmin-form-group name="product_link" label="Link *">
    <input type="text" placeholder="Product Link" class="form-control" name="product_link" id="product_link" required
    value="{{ old('product_link', $product->product_link) }}">
</x-ladmin-form-group>
<x-ladmin-form-group name="brand" label="Brand">
    <select class="form-select" data-control="select2" name="brand_id" data-placeholder="Select an option">
        <option>------ Select Brand --------</option>
        @foreach ($brand as $name => $id)
            <option value="{{$id}}" {{ $edit ? ( old('product_name', $product->detail->brand_id) == $id ? 'selected' : '' ) : '' }}>
                {{__($name)}}
            </option>
        @endforeach
    </select>
</x-ladmin-form-group>
<hr>
<h3>Product Details</h3>
<br>
<div class="row">
    <div class="col-sm-6">
        <h5>Quantity & Prices</h5>
        <div class="pl-2" id="prices">
            <br>
            <x-ladmin-form-group name="qty" label="Product Quantity Stock">
                <div class="input-group mb-5">
                    <input type="number" min="0" class="form-control" name="qty" aria-label="Amount"
                    value="{{ old('qty', $product->detail->qty ?? 0) }}"/>
                    <span class="input-group-text"> pcs</span>
                </div>
            </x-ladmin-form-group>
            <x-ladmin-form-group name="base_price" label="Base Price">
                <div class="input-group mb-5">
                    <span class="input-group-text">Rp</span>
                    <input id="base" type="text" class="form-control" name="base_price"
                    value="{{ old('base_price', rupiah_format($product->detail->base_price ?? 0)) }}" aria-label="Amount (to the nearest rupiah)"/>
                </div>
            </x-ladmin-form-group>

            <x-ladmin-form-group name="retail_price" label="Retail Price">
                <div class="input-group mb-5">
                    <span class="input-group-text">Rp</span>
                    <input id="retail" type="text" class="form-control" name="retail_price"
                    value="{{ old('qty', rupiah_format($product->detail->retail_price ?? 0)) }}" aria-label="Amount (to the nearest rupiah)"/>
                </div>
            </x-ladmin-form-group>

            <x-ladmin-form-group name="after_discount_price" label="After discount price">
                <div class="input-group mb-5">
                    <span class="input-group-text">Rp</span>
                    <input id="discount" type="text" class="form-control" name="after_discount_price"
                     value="{{ old('qty', rupiah_format($product->detail->after_discount_price ?? 0)) }}" aria-label="Amount (to the nearest rupiah)"/>
                    <span class="input-group-text">%</span>
                    <input type="text" class="form-control" id="percent"
                    @if ($edit)
                        value="{{100 - round(100 * ($product->detail->after_discount_price / $product->detail->base_price), 0)}}"
                    @endif
                    placeholder="Percentage" aria-label="Percent" disabled/>
                </div>
            </x-ladmin-form-group>
        </div>
    </div>
    <div class="col-sm-6">
        <h5>Product Variant</h5>
        <br>
        <x-ladmin-form-group name="sizes" label="Sizes">
            @livewire('size', [
                'current_size' => $product->sizes()
                    ->select('size_id as id', 'size_title as value')
                    ->get(),
                'edit' => $edit ])
        </x-ladmin-form-group>
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
                        'signature_player_name as title',
                        'signature_image as image'
                    )->get(),
                'edit' => $edit ])
        </x-ladmin-form-group>
    </div>
</div>
<hr>
<br>
<!--begin::Input group-->
<div class="fv-row mb-10">
    <!--begin::Label-->
    <label class="required fw-bold fs-6 mb-2">Product description</label>
    <!--end::Label-->

    <!--begin::Input-->
    <textarea name="description" id="kt_docs_ckeditor_classic">
        {!! old('qty', $product->description) !!}
    </textarea>
</div>
<hr>

@include('components.is_active', ['is_active' => $product->is_active, 'edit' => $edit])

@push('scripts')
    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script src="{{asset('demo1/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#kt_docs_ckeditor_classic'))
            .then(editor => {

            })
            .catch(error => {

            });
    </script>
    <script>
        let basePriceValidator = 0;
        let discountPriceValidator = 0;

        document.getElementById('base').addEventListener("change", function(e) {
            basePriceValidator = this.value.replace(/\D/g,'');
        });

        document.getElementById('discount').addEventListener("change", function(e) {
            discountPriceValidator = this.value.replace(/\D/g,'');
        });

        const form = document.getElementById('form');
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
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
                                message: 'Brand is required'
                            }
                        }
                    },
                    'tag': {
                        validators: {
                            notEmpty: {
                                message: 'Tag is required'
                            }
                        }
                    },
                    'size': {
                        validators: {
                            notEmpty: {
                                message: 'Size is required'
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
                    'qty': {
                        validators: {
                            notEmpty: {
                                message: 'Quantity is required'
                            }
                        }
                    },
                    'base_price': {
                        validators: {
                            notEmpty: {
                                message: 'Base Price is required'
                            }
                        }
                    },
                    'retail_price': {
                        validators: {
                            notEmpty: {
                                message: 'Retail Price is required'
                            }
                        }
                    },
                    'after_discount_price': {
                        value: discountPriceValidator,
                        validators: {
                            notEmpty: {
                                message: 'After discount price is required'
                            }
                        }
                    },
                    'description': {
                        validators: {
                            notEmpty: {
                                message: 'Description is required'
                            }
                        }
                    },
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

        tags.on("change", function(){
            validator.revalidateField('tag');
        });

        sizes.on("change", function(){
            validator.revalidateField('size');
        });

        categories.on("change", function(){
            validator.revalidateField('category');
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
        var base = document.getElementById("base");
        var retail = document.getElementById("retail");
        var discount = document.getElementById("discount");
        var percent = document.getElementById("percent");
        var prices = document.getElementById("prices");

        var rawPriceBase = base.value.replace(/\D/g,'');
        var rawPriceDiscount = discount.value.replace(/\D/g,'');

        let result = 0;

        base.addEventListener("keyup", function(e) {
            result = 0;
            rawPriceBase = base.value.replace(/\D/g,'');
            result = 100 - Math.round(100 * (rawPriceDiscount / rawPriceBase));
            percent.value = result;
            base.value = formatRupiah(this.value);
        });

        retail.addEventListener("keyup", function(e) {
            retail.value = formatRupiah(this.value);
        });

        discount.addEventListener("keyup", function(e) {
            result = 0;
            rawPriceDiscount = discount.value.replace(/\D/g,'');
            result = 100 - Math.round(100 * (rawPriceDiscount / rawPriceBase));
            percent.value = result;
            discount.value = formatRupiah(this.value);
        });

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
@endpush
