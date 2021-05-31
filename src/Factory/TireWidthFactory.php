<?php

namespace App\Factory;

use App\Entity\Tire\TireWidth;
use App\Repository\Tire\TireWidthRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireWidth|Proxy createOne(array $attributes = [])
 * @method static TireWidth[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireWidth|Proxy find($criteria)
 * @method static TireWidth|Proxy findOrCreate(array $attributes)
 * @method static TireWidth|Proxy first(string $sortedField = 'id')
 * @method static TireWidth|Proxy last(string $sortedField = 'id')
 * @method static TireWidth|Proxy random(array $attributes = [])
 * @method static TireWidth|Proxy randomOrCreate(array $attributes = [])
 * @method static TireWidth[]|Proxy[] all()
 * @method static TireWidth[]|Proxy[] findBy(array $attributes)
 * @method static TireWidth[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireWidth[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireWidthRepository|RepositoryProxy repository()
 * @method TireWidth|Proxy create($attributes = [])
 */
final class TireWidthFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireWidth $tireWidth) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireWidth::class;
    }
}
