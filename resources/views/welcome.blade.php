<!DOCTYPE html>
<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="./css/vuetify.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>NS Software</title>
</head>
<body>
<div id="budgetapp"></div>
<!-- built files will be auto injected -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
