<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => 'f8b5cf8a-aab8-4afc-953c-14e0c40b46c9',
            'name' => 'Administrador',
            'description' => '',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
}
