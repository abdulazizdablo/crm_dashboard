<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [


            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->email(),
            'company_city' => $this->faker->city(),
            'contact_phone_number' => $this->faker->phoneNumber(),
            'company_zip'  => $this->faker->countryCode(),
            'company_name' => $this->faker->name(),
            'company_vat' => $this->faker->randomNumber(5),
            'company_address' => $this->faker->address()


        ];
    }
}
