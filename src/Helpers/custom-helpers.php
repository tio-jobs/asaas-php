<?php

if (!function_exists('cleanString')) {
    function cleanString(string $string): string|null
    {
        return preg_replace('/[^A-Za-z0-9]/', '', $string);
    }
}

if (!function_exists('sanitize')) {
    function sanitize(string $data): string|null
    {
        return cleanString($data);
    }
}

if (!function_exists('get_remote_ip')) {
    function get_remote_ip(): string
    {
        return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
}

if (!function_exists('attach')) {
    /** @return array<string,string> */
    function attach(string $filePath, string $fieldName = 'file'): array
    {
        /** @phpstan-ignore-next-line  */
        $fileName = str($filePath)->afterLast('/')->toString();

        return [
            'name' => $fieldName,
            'contents' => file_get_contents($filePath),
            'filename' => $fileName,
        ];
    }
}
