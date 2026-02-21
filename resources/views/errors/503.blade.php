<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Maintenance - {{ config('app.name', 'SNEAKERS.ID') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-secondary-bg-subtle: #f4f4f4;
            --bs-danger: #EA501F;
            --bs-danger-rgb: 234, 80, 31;
        }
        body {
            font-family: 'Roboto Condensed', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bs-secondary-bg-subtle);
            color: #212529;
        }
        .anton {
            font-family: 'Anton', sans-serif;
        }
        .btn-danger {
            background-color: var(--bs-danger);
            border-color: var(--bs-danger);
        }
        .btn-danger:hover {
            background-color: #d4461a;
            border-color: #d4461a;
            color: #fff;
        }
        .btn-outline-dark {
            border-color: var(--bs-border-color);
        }
        .icon-wrap {
            width: 100px;
            height: 100px;
            background: rgba(var(--bs-danger-rgb), 0.12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            line-height: 0;
        }
        .icon-wrap .iconify {
            font-size: 48px;
            color: var(--bs-danger);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-50">
            <div class="col-12 col-md-8 col-lg-6 text-center">
                <div class="icon-wrap">
                    <span class="iconify" data-icon="majesticons:clock-line"></span>
                </div>
                <h1 class="display-1 fw-bold text-danger mb-3">503</h1>
                <h2 class="h3 fw-semibold mb-3">We'll Be Right Back</h2>
                <p class="text-muted mb-4">
                    We're performing scheduled maintenance to improve your experience. Please check back in a few minutes.
                </p>
                @if (isset($exception) && $exception->getMessage())
                    <p class="small text-muted mb-4">{{ $exception->getMessage() }}</p>
                @endif
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill px-4" onclick="window.location.reload()">
                        <span class="iconify me-2" data-icon="majesticons:refresh-line"></span>
                        Try Again
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
