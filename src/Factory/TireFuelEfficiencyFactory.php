<?php

namespace App\Factory;

use App\Entity\Tire\TireFuelEfficiency;
use App\Repository\Tire\TireFuelEfficiencyRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireFuelEfficiency|Proxy createOne(array $attributes = [])
 * @method static TireFuelEfficiency[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireFuelEfficiency|Proxy find($criteria)
 * @method static TireFuelEfficiency|Proxy findOrCreate(array $attributes)
 * @method static TireFuelEfficiency|Proxy first(string $sortedField = 'id')
 * @method static TireFuelEfficiency|Proxy last(string $sortedField = 'id')
 * @method static TireFuelEfficiency|Proxy random(array $attributes = [])
 * @method static TireFuelEfficiency|Proxy randomOrCreate(array $attributes = [])
 * @method static TireFuelEfficiency[]|Proxy[] all()
 * @method static TireFuelEfficiency[]|Proxy[] findBy(array $attributes)
 * @method static TireFuelEfficiency[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireFuelEfficiency[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireFuelEfficiencyRepository|RepositoryProxy repository()
 * @method TireFuelEfficiency|Proxy create($attributes = [])
 */
final class TireFuelEfficiencyFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireFuelEfficiency $tireFuelEfficiency) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireFuelEfficiency::class;
    }
}
