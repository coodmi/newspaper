<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // একটি র‍্যান্ডম আইপি এবং ইউজার এজেন্ট তৈরি করা হচ্ছে
        $ip = $this->faker->ipv4();
        $userAgent = $this->faker->userAgent();

        return [
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            // আইপি এবং ইউজার এজেন্ট দিয়ে একটি ইউনিক আইডি তৈরি করা হচ্ছে
            'visitor_identifier' => md5($ip . $userAgent),
            // শেষ ৭ দিনের মধ্যে একটি র‍্যান্ডম তারিখ এবং সময় তৈরি করা হচ্ছে
            // 'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-7 days', '-4 days'),
            'updated_at' => now(),
        ];
    }
}