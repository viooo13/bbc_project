<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect to Login - Bakso Bunderan Ciomas</title>
    <script>
        // Redirect to universal login
        window.location.href = "{{ route('universal.login') }}";
    </script>
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h2>Redirecting to login page...</h2>
        <p>If you are not redirected automatically, <a href="{{ route('universal.login') }}">click here</a>.</p>
    </div>
</body>
</html>
