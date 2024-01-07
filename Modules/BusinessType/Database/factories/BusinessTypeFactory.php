<?php

namespace Modules\BusinessType\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BusinessType\Entities\BusinessType;

class BusinessTypeFactory extends Factory
{
    protected $model = BusinessType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
