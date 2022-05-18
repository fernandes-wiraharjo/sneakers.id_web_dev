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
        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks active" onclick="openCity(event, 'Men`s')">Men's</button>
            <button class="tablinks" onclick="openCity(event, 'Women`s')">Women's</button>
            <button class="tablinks" onclick="openCity(event, 'Kid`s')">Kid's</button>
        </div>

        <!-- Tab content -->
        <div id="Men`s" class="tabcontent" style="display: block">
            <h1 class="Heading u-h2 text-center">Men's Sizes</h1>
            <div class="table-header">
				<div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">US</a></div>
				<div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
				<div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">EU</a></div>
				<div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">CM</a></div>
			</div>
			<div class="table-content">
				@foreach ($men_sizes as $item)
					<div class="table-row">
						<div class="table-data">{{ $item->US }}</div>
						<div class="table-data">{{ $item->UK }}</div>
						<div class="table-data">{{ $item->EU }}</div>
						<div class="table-data">{{ $item->CM }}</div>
					</div>
				@endforeach
			</div>
        </div>

        <div id="Women`s" class="tabcontent">
            <h1 class="Heading u-h2 text-center">Women's Sizes</h1>
            <div class="table-header">
				<div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">US</a></div>
				<div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
				<div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">EU</a></div>
				<div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">CM</a></div>
			</div>
			<div class="table-content">
				@foreach ($women_sizes as $item)
					<div class="table-row">
						<div class="table-data">{{ $item->US }}</div>
						<div class="table-data">{{ $item->UK }}</div>
						<div class="table-data">{{ $item->EU }}</div>
						<div class="table-data">{{ $item->CM }}</div>
					</div>
				@endforeach
			</div>
        </div>

        <div id="Kid`s" class="tabcontent">
            <h1 class="Heading u-h2 text-center">Kid's Sizes</h1>
            <div class="table-header">
				<div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">US</a></div>
				<div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
				<div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">EU</a></div>
				<div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">CM</a></div>
			</div>
			<div class="table-content">
				@foreach ($kid_sizes as $item)
					<div class="table-row">
						<div class="table-data">{{ $item->US }}</div>
						<div class="table-data">{{ $item->UK }}</div>
						<div class="table-data">{{ $item->EU }}</div>
						<div class="table-data">{{ $item->CM }}</div>
					</div>
				@endforeach
			</div>
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
