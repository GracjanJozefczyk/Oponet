<?php

namespace App\Factory;

use App\Entity\Tire\TireWetGrip;
use App\Repository\Tire\TireWetGripRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireWetGrip|Proxy createOne(array $attributes = [])
 * @method static TireWetGrip[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireWetGrip|Proxy find($criteria)
 * @method static TireWetGrip|Proxy findOrCreate(array $attributes)
 * @method static TireWetGrip|Proxy first(string $sortedField = 'id')
 * @method static TireWetGrip|Proxy last(string $sortedField = 'id')
 * @method static TireWetGrip|Proxy random(array $attributes = [])
 * @method static TireWetGrip|Proxy randomOrCreate(array $attributes = [])
 * @method static TireWetGrip[]|Proxy[] all()
 * @method static TireWetGrip[]|Proxy[] findBy(array $attributes)
 * @method static TireWetGrip[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireWetGrip[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireWetGripRepository|RepositoryProxy repository()
 * @method TireWetGrip|Proxy create($attributes = [])
 */
final class TireWetGripFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireWetGrip $tireWetGrip) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireWetGrip::class;
    }
}
