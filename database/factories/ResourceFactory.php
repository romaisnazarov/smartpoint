<?php

namespace Database\Factories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ResourceFactory extends Factory
{
    protected $model = Resource::class;


    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'CatBlogs.net',
            'MeowPosts.org',
            'PurrFeed.com',
            'WhiskerWire.info',
            'FelineFeed.co',
            'KittyChatter.io',
            'PawsAndWhiskers.site',
            'TailTale.blog',
            'ClawCast.net',
            'FurryUpdates.org'
        ]);

        return [
            'name' => $name,
            'api_url' => $this->generateApiUrl($name),
        ];
    }

    /**
     * Генерация URL API на основе имени ресурса.
     *
     * @param string $name
     * @return string
     */
    private function generateApiUrl(string $name): string
    {
        // Убираем домен верхнего уровня из имени для базового URL
        $baseName = preg_replace('/\.[a-z]{2,4}$/', '', $name);
        $domain = Str::lower(Str::kebab($baseName));

        return 'https://' . $domain . '/api';
    }
}
