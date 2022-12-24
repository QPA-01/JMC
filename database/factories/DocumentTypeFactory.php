<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocumentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => '24f56c57-e3f4-452a-b1d6-e49dc9648834',
            'name' => 'cedula',
            'abbreviation' => 'C.C.',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
}
