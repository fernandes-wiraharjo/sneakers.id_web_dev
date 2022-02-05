<div class="mr-5 ml-5 mt-3 p-2 mb-2 text-center">
    @livewire('product-image', ['image' => $product->images()->get('image_url')->toArray(), 'edit' => $edit])
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
        <div class="pl-2">
            <br>
            <x-ladmin-form-group name="qty" label="Product Quantity Stock">
                <div class="input-group mb-5">
                    <input type="text" class="form-control" name="qty" aria-label="Amount"
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

            <x-ladmin-form-group name="selling_price" label="Retail Price">
                <div class="input-group mb-5">
                    <span class="input-group-text">Rp</span>
                    <input id="retail" type="text" class="form-control" name="retail_price"
                    value="{{ old('qty', rupiah_format($product->detail->retail_price ?? 0)) }}" aria-label="Amount (to the nearest rupiah)"/>
                </div>
            </x-ladmin-form-group>

            <x-ladmin-form-group name="selling_price" label="After discount price">
                <div class="input-group mb-5">
                    <span class="input-group-text">Rp</span>
                    <input id="discount" type="text" class="form-control" name="after_discount_price"
                     value="{{ old('qty', rupiah_format($product->detail->after_discount_price ?? 0)) }}" aria-label="Amount (to the nearest rupiah)"/>
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
<h5>Product Description</h5>
<br>
<textarea name="description" id="kt_docs_ckeditor_classic">
    {!! old('qty', $product->description) !!}
</textarea>
<hr>

@include('components.is_active', ['is_active' => $product->is_active, 'edit' => $edit])

@push('scripts')
    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script src="{{asset('demo1/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#kt_docs_ckeditor_classic'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        var base = document.getElementById("base");
        var retail = document.getElementById("retail");
        var discount = document.getElementById("discount");

        base.addEventListener("keyup", function(e) {
            base.value = formatRupiah(this.value);
        });

        retail.addEventListener("keyup", function(e) {
            retail.value = formatRupiah(this.value);
        });

        discount.addEventListener("keyup", function(e) {
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
