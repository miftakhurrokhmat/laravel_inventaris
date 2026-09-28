<?php

namespace Database\Factories;

use App\Models\Inventaris;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventaris>
 */
class InventarisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'kode' => 'INV-' . $this->faker->unique()->numerify('########-####'),
            'nama' => $this->faker->words(2, true),
            'tanggal_perolehan' => $this->faker->date(),
            'harga' => $this->faker->numberBetween(100000, 10000000),
        ];
    }
}
