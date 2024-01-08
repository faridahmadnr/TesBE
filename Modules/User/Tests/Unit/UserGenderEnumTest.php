<?php

use Modules\User\Enums\UserGenderEnum;

it('has correct labels for each gender', function ($gender, $label) {
    expect($gender->label())->toEqual($label);
})->with([
    [UserGenderEnum::MALE, 'Male'],
    [UserGenderEnum::FEMALE, 'Female'],
]);

it('has correct values for each gender', function ($gender, $value) {
    expect($gender->value)->toEqual($value);
})->with([
    [UserGenderEnum::MALE, 'male'],
    [UserGenderEnum::FEMALE, 'female'],
]);
