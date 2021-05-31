<?php

namespace App\Factory;

use App\Entity\Tire\TireBrand;
use App\Repository\Tire\TireBrandRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireBrand|Proxy createOne(array $attributes = [])
 * @method static TireBrand[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireBrand|Proxy find($criteria)
 * @method static TireBrand|Proxy findOrCreate(array $attributes)
 * @method static TireBrand|Proxy first(string $sortedField = 'id')
 * @method static TireBrand|Proxy last(string $sortedField = 'id')
 * @method static TireBrand|Proxy random(array $attributes = [])
 * @method static TireBrand|Proxy randomOrCreate(array $attributes = [])
 * @method static TireBrand[]|Proxy[] all()
 * @method static TireBrand[]|Proxy[] findBy(array $attributes)
 * @method static TireBrand[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireBrand[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireBrandRepository|RepositoryProxy repository()
 * @method TireBrand|Proxy create($attributes = [])
 */
final class TireBrandFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => ucfirst(self::faker()->unique()->word),
            'description' => self::faker()->realTextBetween(200, 600),
            'imageUrl' => 'tire_brand_example.jpeg'
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(TireBrand $tireBrand) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireBrand::class;
    }
}
