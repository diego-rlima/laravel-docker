<?php

namespace App\Domains\Account\Database\Factories;

use Illuminate\Support\Str;
use App\Domains\Account\Models\User;
use App\Support\Domains\Database\Factory;

class UserFactory extends Factory
{
    /**
     * Factory for the User Model.
     *
     * @var User
     */
    protected $model = User::class;

    /**
     * Array with all fields.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
