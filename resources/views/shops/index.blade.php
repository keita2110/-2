<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>toppage</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
        　TopPage
        </x-slot>
        <div class="user">
        ユーザー名：{{ Auth::user()->name }}
        </div>
        
        <a href='/search'>近くのラーメン屋を探す</a>
        
        <a href='/shops/create'>店を紹介する</a>
        
        
    </x-app-layout>
    </body>
</html>
