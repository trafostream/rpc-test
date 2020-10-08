<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Get Form</title>
    </head>
    <body>
        <h1>Page UID #{{ $page_uid }}</h1>
        @widget('Forms', ['page_uid' => $page_uid])
    </body>
</html>
