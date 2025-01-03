<?php

use Modules\User\Enums\UserStatusEnum;

it('has correct value for each status', function ($status, $value) {
    expect($status->value)->toEqual($value);
})->with([
    [UserStatusEnum::INACTIVE, 0],
    [UserStatusEnum::ACTIVE, 1],
    [UserStatusEnum::BLOCK, 2],
]);

it('has correct label for each status', function ($status, $label) {
    expect($status->label())->toEqual($label);
})->with([
    [UserStatusEnum::INACTIVE, 'Inactive'],
    [UserStatusEnum::ACTIVE, 'Active'],
    [UserStatusEnum::BLOCK, 'Blocked'],
]);
