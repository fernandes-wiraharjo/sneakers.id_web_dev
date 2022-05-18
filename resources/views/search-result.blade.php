<html class="no-js" lang="en">
@include('partials.layout.header')
<style>
    $base-spacing-unit: 24px;
    $half-spacing-unit: $base-spacing-unit - 4;

    $color-alpha: #1772FF;
    $color-form-highlight: #EEEEEE;

    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    #main {
        margin-top: unset !important;
    }

    .table-container {
        /* margin-top: 15%; */
        /* margin-bottom: 5%; */
        margin-right: auto;
        margin-left: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 50vh;
        max-height: 85vh;
        height: 800px;
        /* position: relative; */
    }

    .table {
        padding-top: 10%;
        padding-left: 10%;
        padding-right: 10%;
        width: 100%;
        border: 1px solid $color-form-highlight;
        overflow-x: auto;
        white-space: inherit !important;
    }

    .table-header {
        display: inline-flex;
        width: 100%;
        background: #000;
        /* padding:($half-spacing-unit * 1.5) 0; */
    }

    .table-content {
        height: 50%;
        max-height: 75vh;
        overflow-y: auto;
        overflow-x: auto;
    }

    .table-row {
        display: inline-flex;
        width: 100%;
        /* padding:($half-spacing-unit * 1.5) 0; */

        /* &:nth-of-type(odd) {
                background:$color-form-highlight;
            } */
    }

    .table-data,
    .header__item {
        flex: 1 1 20%;
        text-align: center;
        padding: 10px 10px;
        max-width: auto;
        min-width: 50px;
    }

    .header__item {
        text-transform: uppercase;
    }

    .filter__link {
        color: white;
        text-decoration: none;
        position: relative;
        display: inline-block;
        padding-left: $base-spacing-unit;
        padding-right: $base-spacing-unit;

        &::after {
            content: '';
            position: absolute;
            right: -($half-spacing-unit * 1.5);
            color: white;
            font-size: 24px;
            top: 50%;
            transform: translateY(-50%);
        }
    }

    @media only screen and (max-width: 715px) {
        .table-container {
            position: relative;
        }

        .table {
            padding-left: unset;
            padding-right: unset;
        }
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        margin-top: 5%;
        margin-left: 5%;
        margin-right: 5%;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        margin-bottom: 5%;
        margin-left: 5%;
        margin-right: 5%;
    }

</style>

<body class="prestige--v4 template-collection">
    @include('partials.layout.navbar')
    <main id="main" role="main">
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
    </main>
    @include('partials.layout.footer')

    @include('partials.layout.script')

    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>
