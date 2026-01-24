<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SNEAKERS.ID</title>
    <meta name="description" content="@yield('description')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://elfsightcdn.com">
    <link rel="dns-prefetch" href="https://elfsightcdn.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bs-secondary-bg-subtle: #f4f4f4;
            --bs-danger: #EA501F;
            --bs-danger-rgb: 234, 80, 31;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        body {
            font-family: 'Roboto Condensed', sans-serif;
        }
        .anton {
            font-family: 'Anton', sans-serif;
        }
        .btn-dark {
            background-color: black;
        }
        .btn-outline-dark {
            border-color: var(--bs-border-color);
        }
        .btn-light {
            background-color: #f2f2f2;
        }
        .btn-danger {
            background-color: var(--bs-danger);
            border-color: var(--bs-danger);
        }
        .cart-counter {
            font-size: 10px;
            font-weight: bold;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .navbar .dropdown-item:focus,
        .navbar .dropdown-item:active,
        .navbar .dropdown-item:hover {
            background: black;
            color: white;
        }
        #footer {
            background: linear-gradient(150deg, #000000 0%, #000000 70%, #01132a 100%);
        }
        .footer-brand {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 50%;
        }
        .header-image-wrapper {
            position: relative;
            z-index: 1;
            aspect-ratio: 10 / 3;
            display: flex;
        }
        .header-image-wrapper img {
            object-fit: cover;
            width: 100%;
            object-position: bottom;
        }
        .product-list-container {
            margin-top: -1.5rem;
        }
        /* Pagination Styles */
        .pagination .page-item {
            margin: 0 0.25rem;
        }
        .pagination .page-link {
            border: 1px solid #dee2e6;
            padding: 0.25rem 0.75rem;
            color: #212529;
            background-color: #fff;
            border-radius: 0.25rem;
        }
        .pagination .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
        }
        .pagination .page-item.active .page-link {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
        @media (max-width: 768px) {
            .header-image-wrapper {
                aspect-ratio: 3 / 1;
            }
            .header-image-wrapper img {
                object-position: bottom;
            }
            .product-list-container {
                margin-top: -7px;
            }
        }
        /* Search Bar Styles */
        #searchBar {
            transition: max-height 0.3s ease, opacity 0.3s ease;
        }
        
        #searchBar input:focus {
            outline: none;
            box-shadow: none;
        }
        
        #searchResultsList li {
            padding: 10px 0;
            border-bottom: 1px solid #e5e5e5;
        }
        
        #searchResultsList li:last-child {
            border-bottom: none;
        }
        
        #searchResultsList a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }
        
        #searchResultsList a:hover {
            color: #000;
        }

        .category-pills {
            border: 1px solid var(--bs-danger);
            color: var(--bs-danger);
            border-radius: var(--bs-border-radius-pill);
            padding: .25rem 1rem;
            width: fit-content;
            text-transform: uppercase;
            font-size: .85rem;
        }
        .nowrap, .no-wrap {
            white-space: nowrap;
        }
        .w-fit-content {
            width: fit-content;
        }
        .search-result-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            margin-right: 12px;
            border-radius: 4px;
            flex-shrink: 0;
        }
        
        .search-result-info {
            flex: 1;
        }
        
        /* Mobile Menu Offcanvas - Fit Content */
        #mobileMenuOffcanvas.offcanvas {
            --bs-offcanvas-height: fit-content !important;
            height: fit-content !important;
            max-height: 100vh;
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>
<body>
    @include('bootstrap.parts.navbar')
    @include('bootstrap.parts.navbar-mobile')
    @livewire('toast-notification')

    @yield('content')

    @stack('scripts')
    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('toast_error'))
                Livewire.emit('showToast', {
                    type: 'error',
                    message: {!! json_encode(session('toast_error')) !!}
                });
            @endif
            @if(session('toast_success'))
                Livewire.emit('showToast', {
                    type: 'success',
                    message: {!! json_encode(session('toast_success')) !!}
                });
            @endif
            @if(session('toast_warning'))
                Livewire.emit('showToast', {
                    type: 'warning',
                    message: {!! json_encode(session('toast_warning')) !!}
                });
            @endif
            @if(session('toast_info'))
                Livewire.emit('showToast', {
                    type: 'info',
                    message: {!! json_encode(session('toast_info')) !!}
                });
            @endif
        });
    </script>

    @include('bootstrap.parts.footer')
</body>
</html>