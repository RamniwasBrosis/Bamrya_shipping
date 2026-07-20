<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 | Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap (optional) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .error-page {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-box {
            text-align: center;
        }
        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="error-page">
    <div class="error-box">
        <div class="error-code">404</div>
        <h3 class="mb-3">Pro-Forma Not Created For This Job</h3>
        <p class="text-muted mb-4">
            The page you are looking for doesn’t exist or has been moved.
        </p>

        <a href="{{ url('/') }}" class="btn btn-primary">
            Go to Dashboard
        </a>
    </div>
</div>

</body>
</html>
