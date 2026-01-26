<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKERS.ID</title>
    <link rel="shortcut icon" href="{{ $favicon }}">
    <link rel="apple-touch-icon" href="{{ $favicon }}">
    <link rel="icon" href="{{ $favicon }}">
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
        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
            animation: slideInRight 0.3s ease-out;
        }
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @media (max-width: 576px) {
            .floating-alert {
                right: 10px;
                left: 10px;
                min-width: auto;
                max-width: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Floating Alert Container --}}
    <div id="floatingAlertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 9999; max-width: 500px; width: 100%;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
                {{ is_array(session('success')) ? (isset(session('success')[0]) ? (is_array(session('success')[0]) ? implode(', ', session('success')[0]) : session('success')[0]) : implode(', ', session('success'))) : session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
                {{ is_array(session('error')) ? (isset(session('error')[0]) ? (is_array(session('error')[0]) ? implode(', ', session('error')[0]) : session('error')[0]) : implode(', ', session('error'))) : session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('toast_error'))
            <div class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
                {{ is_array(session('toast_error')) ? (isset(session('toast_error')[0]) ? (is_array(session('toast_error')[0]) ? implode(', ', session('toast_error')[0]) : session('toast_error')[0]) : implode(', ', session('toast_error'))) : session('toast_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('toast_success'))
            <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
                {{ is_array(session('toast_success')) ? (isset(session('toast_success')[0]) ? (is_array(session('toast_success')[0]) ? implode(', ', session('toast_success')[0]) : session('toast_success')[0]) : implode(', ', session('toast_success'))) : session('toast_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('toast_warning'))
            <div class="alert alert-warning alert-dismissible fade show floating-alert" role="alert">
                {{ is_array(session('toast_warning')) ? (isset(session('toast_warning')[0]) ? (is_array(session('toast_warning')[0]) ? implode(', ', session('toast_warning')[0]) : session('toast_warning')[0]) : implode(', ', session('toast_warning'))) : session('toast_warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('toast_info'))
            <div class="alert alert-info alert-dismissible fade show floating-alert" role="alert">
                {{ is_array(session('toast_info')) ? (isset(session('toast_info')[0]) ? (is_array(session('toast_info')[0]) ? implode(', ', session('toast_info')[0]) : session('toast_info')[0]) : implode(', ', session('toast_info'))) : session('toast_info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @yield('content')
    @stack('scripts')
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.floating-alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>