<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SupplierFactory extends Factory
{
         /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'    => fake()->name(),
            'uuid'    => fake()->uuid(),
            'email'   => fake()->unique()->safeEmail(),
            'phone'   => fake()->phoneNumber(),
            'city'    => fake()->city(),
            'country' => fake()->country(),
            'address' => fake()->address(),
        ];
    }
}
