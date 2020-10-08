<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Form</title>
    </head>
    <body>
        <h1>Page UID #{{ $page_uid }}</h1>
        @widget('Forms',
            [
                'page_uid' => $page_uid,
                'fields' => [
                    ['name' => 'n1', 'value' => 'v1'],
                    ['name' => 'n2', 'value' => 'v2'],
                    ['name' => 'n3', 'value' => 'v3'],
                ]
            ])
    </body>
</html>
