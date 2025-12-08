<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets-admin/img/favicon.jpg') }}">

    {{-- Start CSS --}}
    @include('layouts.admin.css')
    {{-- End CSS --}}
</head>

<body class="account-page">
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    {{-- Start Main Content --}}
    @yield('content')
    {{-- End Main Content --}}

    {{-- Start Js --}}
    @include('layouts.admin.js')
    {{-- End Js --}}
</body>

</html>
