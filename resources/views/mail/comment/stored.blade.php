<?php
    /** @var \App\Models\Comment $comment */
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <p>Автор: {{ $comment->profile->first_name }}</p>
        <p>Дата: {{ $comment->created_at->format('d.m.Y H:i') }}</p>
        <p>Текст: {{ $comment->content }}</p>
    </body>
</html>
