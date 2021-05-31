<?php

namespace App\Factory;

use App\Entity\Vehicle\VehicleType;
use App\Repository\Vehicle\VehicleTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static VehicleType|Proxy createOne(array $attributes = [])
 * @method static VehicleType[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static VehicleType|Proxy find($criteria)
 * @method static VehicleType|Proxy findOrCreate(array $attributes)
 * @method static VehicleType|Proxy first(string $sortedField = 'id')
 * @method static VehicleType|Proxy last(string $sortedField = 'id')
 * @method static VehicleType|Proxy random(array $attributes = [])
 * @method static VehicleType|Proxy randomOrCreate(array $attributes = [])
 * @method static VehicleType[]|Proxy[] all()
 * @method static VehicleType[]|Proxy[] findBy(array $attributes)
 * @method static VehicleType[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static VehicleType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static VehicleTypeRepository|RepositoryProxy repository()
 * @method VehicleType|Proxy create($attributes = [])
 */
final class VehicleTypeFactory extends ModelFactory
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
            // ->afterInstantiate(function(VehicleType $vehicleType) {})
        ;
    }

    protected static function getClass(): string
    {
        return VehicleType::class;
    }
}
