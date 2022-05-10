<html class="no-js" lang="en">
    @include('partials.layout.header')
    <style>
        $base-spacing-unit: 24px;
        $half-spacing-unit: $base-spacing-unit - 4;

        $color-alpha: #1772FF;
        $color-form-highlight: #EEEEEE;

        *, *:before, *:after {
            box-sizing:border-box;
        }

        #main {
            margin-top: unset !important;
        }

        .table-container {
            /* margin-top: 15%; */
            /* margin-bottom: 5%; */
            margin-right:auto;
            margin-left:auto;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:50vh;
            max-height: 85vh;
            height: 800px;
            /* position: relative; */
        }

        .table {
            padding-top: 10%;
            padding-left: 10%;
            padding-right: 10%;
            width:100%;
            border:1px solid $color-form-highlight;
            overflow-x: auto;
            white-space: inherit !important;
        }

        .table-header {
            display:inline-flex;
            width:100%;
            background:#000;
            /* padding:($half-spacing-unit * 1.5) 0; */
        }

        .table-content {
            height: 50%;
            max-height: 75vh;
            overflow-y: auto;
        }

        .table-row {
            display:inline-flex;
            width:100%;
            /* padding:($half-spacing-unit * 1.5) 0; */

            /* &:nth-of-type(odd) {
                background:$color-form-highlight;
            } */
        }

        .table-data, .header__item {
            flex: 1 1 20%;
            text-align:center;
            padding: 10px 10px;
            max-width: auto;
            min-width: 50px;
        }

        .header__item {
            text-transform:uppercase;
        }

        .filter__link {
            color:white;
            text-decoration: none;
            position:relative;
            display:inline-block;
            padding-left:$base-spacing-unit;
            padding-right:$base-spacing-unit;

            &::after {
                content:'';
                position:absolute;
                right:-($half-spacing-unit * 1.5);
                color:white;
                font-size:24px;
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
    </style>
    <body class="prestige--v4 template-collection">
        @include('partials.layout.navbar')
        <main id="main" role="main">
            <div class="table-container">
                <div class="table">
                    <div class="table-header">
                        <div class="header__item"><a id="size" class="filter__link" href="#">Size</a></div>
                        <div class="header__item"><a id="men" class="filter__link filter__link--number" href="#">US - Men's</a></div>
                        <div class="header__item"><a id="woman" class="filter__link filter__link--number" href="#">US - Women's</a></div>
                        <div class="header__item"><a id="kids" class="filter__link filter__link--number" href="#">US - Kid's</a></div>
                        <div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
                        <div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">CM</a></div>
                        <div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">EU</a></div>
                    </div>
                    <div class="table-content">
                        @foreach ($sizes as $item)
                            <div class="table-row">
                                <div class="table-data">{{ $item->size_title }}</div>
                                @if ($item->charts->count() > 0)
                                <div class="table-data">{{ $item->charts->where('size_name', "US - Men's")->first()->size_value != "" ? $item->charts->where('size_name', "US - Men's")->first()->size_value : '-' }}</div>
                                <div class="table-data">{{ $item->charts->where('size_name', "US - Women's")->first()->size_value != "" ? $item->charts->where('size_name', "US - Women's")->first()->size_value : '-' }}</div>
                                <div class="table-data">{{ $item->charts->where('size_name', "US - Kid's")->first()->size_value != "" ? $item->charts->where('size_name', "US - Kid's")->first()->size_value : '-' }}</div>
                                <div class="table-data">{{ $item->charts->where('size_name', "UK")->first()->size_value != "" ? $item->charts->where('size_name', "UK")->first()->size_value : '-' }}</div>
                                <div class="table-data">{{ $item->charts->where('size_name', "CM")->first()->size_value != "" ?  $item->charts->where('size_name', "CM")->first()->size_value : '-' }}</div>
                                <div class="table-data">{{ $item->charts->where('size_name', "EU")->first()->size_value != "" ? $item->charts->where('size_name', "EU")->first()->size_value : '-' }}</div>
                                @else
                                    <div class="table-data">-</div>
                                    <div class="table-data">-</div>
                                    <div class="table-data">-</div>
                                    <div class="table-data">-</div>
                                    <div class="table-data">-</div>
                                    <div class="table-data">-</div>
                                    <div class="table-data">-</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
        @include('partials.layout.footer')

        @include('partials.layout.script')
    </body>
</html>
