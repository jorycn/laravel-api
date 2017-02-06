<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jory||jorycn@163.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <script>
        window.OAUTH = {
            'host': "<?php echo env('OAUTH_HOST')?>",
            'client_id': "<?php echo env('OAUTH_CLIENT_ID')?>",
            'secret': "<?php echo env('OAUTH_CLIENT_SECRET')?>",
            'redirect_url': "<?php echo env('OAUTH_REDIRECT_URL')?>"
        };
    </script>
    <script src="/libs/jquery.min.js"></script>
</head>
<body>
    <div id="app"></div>
    <script src="/js/app.js"></script>
</body>
</html>
