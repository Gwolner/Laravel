<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Pages</title>

    @stack('styles')

</head>
<body>
    <div class="container">
        <!-- Diretiva Yield -->
        @yield('content')
    </div>    

    @stack('scripts')
</body>
</html>