<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'logo' => null, // Логотип можна додати окремо
            'website' => $this->faker->url,
        ];
    }
}

