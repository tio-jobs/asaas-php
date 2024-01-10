<?php

declare(strict_types=1);

test('"attach" can properly parse a filepath')
    ->expect(fn () => attach(filePath: $this->filepath, fieldName: 'random-field'))
    ->toBeArray()
    ->toHaveCount(3)
    ->name->toBe('random-field')
    ->contents->toBe('asaas php is the best!')
    ->filename->toBe('asaas-php-test.txt');

beforeEach(function () {
    //Creates a temporary file
    $this->filepath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'asaas-php-test.txt';
    file_put_contents($this->filepath, 'asaas php is the best!');
});

afterEach(function () {
    //Deletes the temporary file
    unlink($this->filepath);
});
