@extends('store-theme._base')

@section('title', 'SEARCH PRODUCT')

@section('body')
    <div id="shopify-section-collection-template" class="shopify-section shopify-section--bordered">
        <section
            data-section-id="collection-template"
            data-section-type="collection"
            data-section-settings='{
                "collectionUrl": "\/collections\/all-products",
                "currentTags": [],
                "sortBy": "manual",
                "filterPosition": "sidebar"
            }'
        >
            <header class="PageHeader">
                <div class="Container">
                    <div class="SectionHeader SectionHeader--center"></div>
                </div>
            </header>

            @livewire('global-search', ['keyword' => $keyword])

        </section>
    </div>
@endsection

