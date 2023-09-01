<?php

namespace App\Common;

class FileReader
{
    private static string $filePath = '';

    public static function read(): string
    {
        return file_get_contents(static::$filePath);
    }

    public static function client(string $filename): FileReader
    {
        static::$filePath = public_path("client-files/$filename");

        return new FileReader;
    }

    public static function server(string $filename): FileReader
    {
        static::$filePath = public_path("server-files/$filename");

        return new FileReader;
    }
}
