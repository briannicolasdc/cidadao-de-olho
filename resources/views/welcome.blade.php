<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cidadão de olho</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body class="antialiased">
        <div>
            <a href="http://127.0.0.1:8000/posts">json</a>
            <?php

use Illuminate\Support\Facades\DB as DB;

try {
    DB::connection()->getPDO();
    echo DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
    echo 'None';
}


            ?>

        </div>

    </body>
</html>
