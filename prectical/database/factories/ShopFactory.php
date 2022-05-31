<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       return [
               'shop_name' => $this->faker->unique()->name(),
               'address' => $this->faker->unique()->address(),
            'email' => $this->faker->unique()->safeEmail(),
              'image' => $this->faker->imageUrl(640,480),
        ];
    }
}
