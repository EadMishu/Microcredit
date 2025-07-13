<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Admin Panel</title>
        @include('backend.layouts.allcss')
</head>

<body class="position-relative">
    <!-- Header start -->
        @include('backend.layouts.header')
    <!-- Header end -->
    <!-- Sidebar start -->
        @include('backend.layouts.sidebar')
    <!-- Sidebar end -->
    <!-- Main start -->
        @yield('content', 'Content not found')
    <!-- Main end -->
         @include('backend.layouts.footer')
    <!-- scripts start -->
        @include('backend.layouts.scripts')
    <!-- scripts end -->
</body>
</html>