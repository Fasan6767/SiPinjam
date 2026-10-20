<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class ItemFactory extends Factory
{
 public function definition(): array
 {
 $namaAlat = fake()->randomElement([
 'Multimeter', 'Osiloskop', 'Solder', 'Arduino Uno', 'Power Supply',
 'Tang Potong', 'Obeng Set', 'Breadboard', 'Raspberry Pi', 'Jangka
Sorong',
 ]);
 return [
 // category_id tidak diisi di sini, tetapi saat factory dipanggil dari seeder
 'code' => 'ALT-' . fake()->unique()->numerify('####'),
 'name' => $namaAlat . ' ' . strtoupper(fake()->bothify('??-##')),
 'stock' => fake()->numberBetween(0, 10),
 'location' => 'Rak ' . fake()->randomElement(['A', 'B', 'C']) .
fake()->numberBetween(1, 5),
 'description' => fake()->sentence(),
 ];
 }
}

