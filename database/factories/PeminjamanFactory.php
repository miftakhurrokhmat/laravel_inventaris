<?php

namespace Database\Factories;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pinjam = $this->faker->dateTimeBetween('-1 month', 'now');
        $rencana = (clone $pinjam)->modify('+7 days');

        return [
            //
            'kode_pinjam' => 'PJM-' . $this->faker->unique()->numerify('########-####'),
            'tanggal_pinjam' => $pinjam,
            'rencana_kembali' => $rencana,
            'status' => 'dipinjam',
        ];
    }
}
