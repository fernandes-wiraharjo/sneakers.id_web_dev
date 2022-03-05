
<input class="form-control form-control-lg d-flex align-items-center" name="category"
    value="{{ old('category', $edit ? $current_category->toJson() : '')}}" id="kt_tagify_category" data-json="{{ $category }}"/>

@push('scripts')
<script>
var inputElm = document.querySelector('#kt_tagify_category');

const categoryList = JSON.parse(inputElm.dataset.json);

// Initialize Tagify script on the above inputs
var categories = new Tagify(inputElm, {
    whitelist: categoryList,
    maxTags: 10,
    dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
    }
});
</script>
@endpush
