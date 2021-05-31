<?php

namespace App\Factory;

use App\Entity\Tire\TireProduct;
use App\Repository\Tire\TireProductRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireProduct|Proxy createOne(array $attributes = [])
 * @method static TireProduct[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireProduct|Proxy find($criteria)
 * @method static TireProduct|Proxy findOrCreate(array $attributes)
 * @method static TireProduct|Proxy first(string $sortedField = 'id')
 * @method static TireProduct|Proxy last(string $sortedField = 'id')
 * @method static TireProduct|Proxy random(array $attributes = [])
 * @method static TireProduct|Proxy randomOrCreate(array $attributes = [])
 * @method static TireProduct[]|Proxy[] all()
 * @method static TireProduct[]|Proxy[] findBy(array $attributes)
 * @method static TireProduct[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireProduct[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireProductRepository|RepositoryProxy repository()
 * @method TireProduct|Proxy create($attributes = [])
 */
final class TireProductFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'price' => self::faker()->numberBetween(100, 1000),
            'quantity' => self::faker()->numberBetween(1, 12),
            'year' => self::faker()->numberBetween(2018, 2021),
            'runOnFlat' => self::faker()->boolean(10),
            'reinforced' => self::faker()->boolean(30),
            'slug' => self::faker()->unique()->slug(3)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(TireProduct $tireProduct) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireProduct::class;
    }
}
