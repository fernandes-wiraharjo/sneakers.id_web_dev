
<input class="form-control form-control-lg d-flex align-items-center" name="signature"
    value="{{ $edit ? $current_signature->toJson() : '' }}" id="kt_tagify_signature" data-json="{{ $signature }}"/>

@push('scripts')
<script>
var input = document.querySelector('#kt_tagify_signature');
var image_url = "{{ asset('images/signature/') }}";

const signatureList = JSON.parse(input.dataset.json);

function tagTemplate(tagData) {
    return `
        <tag title="${tagData.code}"
                contenteditable='false'
                spellcheck='false'
                tabIndex="-1"
                class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                ${this.getAttributes(tagData)}>
            <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
            <div class="d-flex align-items-center">
                <div class='tagify__tag__avatar-wrap ps-0'>
                    <img onerror="this.style.visibility='hidden'" class="rounded-circle w-25px me-2" src="${image_url}/${tagData.image}">
                </div>
                <span class='tagify__tag-text'>${tagData.title}</span>
            </div>
        </tag>
    `
}

function suggestionItemTemplate(tagData) {
    return `
        <div ${this.getAttributes(tagData)}
            class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
            tabindex="0"
            role="option">

            ${tagData.image ? `
                    <div class='tagify__dropdown__item__avatar-wrap me-2'>
                        <img onerror="this.style.visibility='hidden'"  class="rounded-circle w-50px me-2" src="${image_url}/${tagData.image}">
                    </div>` : ''
                }

            <div class="d-flex flex-column">
                <strong>${tagData.title}</strong>
                <span>${tagData.code}</span>
            </div>
        </div>
    `
}

// initialize Tagify on the above input node reference
var tagify = new Tagify(input, {
    tagTextProp: 'code', // very important since a custom template is used with this property as text. allows typing a "value" or a "title" to match input with whitelist
    enforceWhitelist: true,
    skipInvalid: true, // do not remporarily add invalid tags
    dropdown: {
        closeOnSelect: false,
        enabled: 0,
        classtitle: 'signature-list',
        searchKeys: ['title', 'code']  // very important to set by which keys to search for suggesttions when typing
    },
    templates: {
        tag: tagTemplate,
        dropdownItem: suggestionItemTemplate
    },
    whitelist: signatureList
})

tagify.on('dropdown:show dropdown:updated', onDropdownShow)
tagify.on('dropdown:select', onSelectSuggestion)

var addAllSuggestionsElm;

function onDropdownShow(e) {
    var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

    if (tagify.suggestedListItems.length > 1) {
        addAllSuggestionsElm = getAddAllSuggestionsElm();

        // insert "addAllSuggestionsElm" as the first element in the suggestions list
        dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
    }
}

function onSelectSuggestion(e) {
    if (e.detail.elm == addAllSuggestionsElm)
        tagify.dropdown.selectAll.call(tagify);
}

// create a "add all" custom suggestion element every time the dropdown changes
function getAddAllSuggestionsElm() {
    // suggestions items should be based on "dropdownItem" template
    return tagify.parseTemplate('dropdownItem', [{
        class: "addAll",
        title: "Add all",
        code: tagify.settings.whitelist.reduce(function (remainingSuggestions, item) {
            return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
        }, 0) + " Players"
    }]
    )
}
</script>
@endpush
