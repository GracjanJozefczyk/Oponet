<?php

namespace App\Factory;

use App\Entity\Tire\TireNoiseLevel;
use App\Repository\Tire\TireNoiseLevelRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireNoiseLevel|Proxy createOne(array $attributes = [])
 * @method static TireNoiseLevel[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireNoiseLevel|Proxy find($criteria)
 * @method static TireNoiseLevel|Proxy findOrCreate(array $attributes)
 * @method static TireNoiseLevel|Proxy first(string $sortedField = 'id')
 * @method static TireNoiseLevel|Proxy last(string $sortedField = 'id')
 * @method static TireNoiseLevel|Proxy random(array $attributes = [])
 * @method static TireNoiseLevel|Proxy randomOrCreate(array $attributes = [])
 * @method static TireNoiseLevel[]|Proxy[] all()
 * @method static TireNoiseLevel[]|Proxy[] findBy(array $attributes)
 * @method static TireNoiseLevel[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireNoiseLevel[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireNoiseLevelRepository|RepositoryProxy repository()
 * @method TireNoiseLevel|Proxy create($attributes = [])
 */
final class TireNoiseLevelFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireNoiseLevel $tireNoiseLevel) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireNoiseLevel::class;
    }
}
