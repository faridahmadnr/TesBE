<?php

use Carbon\Carbon;

test('appname function should return current app name', function () {
    $expectedAppName = 'Kur Jogja';

    $appName = appName();

    expect($appName)->toEqual($expectedAppName);
});

test('carbon function should current date', function () {
    $carbonInstance = carbon(null);
    expect($carbonInstance)->toBeInstanceOf(Carbon::class);
    expect($carbonInstance->year)->toEqual(date('Y'));
});

test('carbon function should throw exception', function () {
    expect(fn () => carbon('not a date'))->toThrow(Exception::class);
});

test('isDevelopment function should return true', function () {
    $isDevelopment = isDevelopment();
    expect($isDevelopment)->toEqual(true);
});

test('formatCurrency function should return formatted currency', function () {
    $formattedCurrency = formatCurrency(100000);
    expect($formattedCurrency)->toEqual('Rp 100.000');
});
