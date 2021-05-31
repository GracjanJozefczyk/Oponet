<?php

namespace App\Factory;

use App\Entity\Tire\TireHeight;
use App\Repository\Tire\TireHeightRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireHeight|Proxy createOne(array $attributes = [])
 * @method static TireHeight[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireHeight|Proxy find($criteria)
 * @method static TireHeight|Proxy findOrCreate(array $attributes)
 * @method static TireHeight|Proxy first(string $sortedField = 'id')
 * @method static TireHeight|Proxy last(string $sortedField = 'id')
 * @method static TireHeight|Proxy random(array $attributes = [])
 * @method static TireHeight|Proxy randomOrCreate(array $attributes = [])
 * @method static TireHeight[]|Proxy[] all()
 * @method static TireHeight[]|Proxy[] findBy(array $attributes)
 * @method static TireHeight[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireHeight[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireHeightRepository|RepositoryProxy repository()
 * @method TireHeight|Proxy create($attributes = [])
 */
final class TireHeightFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(TireHeight $tireHeight) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireHeight::class;
    }
}
