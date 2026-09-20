<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = \App\Models\Client::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nik' => $this->faker->numerify('################'),
            'whatsapp' => '08'.$this->faker->numerify('##########'),
            'address' => $this->faker->address(),
            'project_name' => $this->faker->sentence(3),
            'project_description' => $this->faker->paragraph(),
            'status' => 'new',
            'agreement_accepted' => true,
            'agreement_accepted_at' => now(),
        ];
    }
}
