
<input class="form-control form-control-lg d-flex align-items-center" name="size-filter"
    value="" id="kt_tagify_size" data-json="{{ $size }}"/>

@push('scripts')
<script>
var inputElm = document.querySelector('#kt_tagify_size');

const tagList = JSON.parse(inputElm.dataset.json);

// Initialize Tagify script on the above inputs
var tags = new Tagify(inputElm, {
    whitelist: tagList,
    maxTags: 15,
    dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
    }
});
</script>
@endpush
