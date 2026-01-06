<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKERS.ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-secondary-bg-subtle: #f4f4f4;
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
    </style>
    @stack('styles')
</head>
<body>
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
</body>
</html>