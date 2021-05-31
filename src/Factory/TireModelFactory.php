<?php

namespace App\Factory;

use App\Entity\Tire\TireModel;
use App\Repository\Tire\TireModelRepository;
use App\Repository\Vehicle\VehicleTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireModel|Proxy createOne(array $attributes = [])
 * @method static TireModel[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireModel|Proxy find($criteria)
 * @method static TireModel|Proxy findOrCreate(array $attributes)
 * @method static TireModel|Proxy first(string $sortedField = 'id')
 * @method static TireModel|Proxy last(string $sortedField = 'id')
 * @method static TireModel|Proxy random(array $attributes = [])
 * @method static TireModel|Proxy randomOrCreate(array $attributes = [])
 * @method static TireModel[]|Proxy[] all()
 * @method static TireModel[]|Proxy[] findBy(array $attributes)
 * @method static TireModel[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireModel[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireModelRepository|RepositoryProxy repository()
 * @method TireModel|Proxy create($attributes = [])
 */
final class TireModelFactory extends ModelFactory
{
    /**
     * @var VehicleTypeRepository
     */
    private $vehicleTypeRepository;

    public function __construct(VehicleTypeRepository $vehicleTypeRepository)
    {
        parent::__construct();

        $this->vehicleTypeRepository = $vehicleTypeRepository;
    }

    protected function getDefaults(): array
    {
        $vehicleType = $this->vehicleTypeRepository->find(53);

        return [
            'vehicleType' => $vehicleType,
            'name' => self::faker()->word,
            'description' => self::faker()->realTextBetween(200, 600),
            'season' => array_rand(array_flip(TireModel::SEASONS)),
            'imagesUrls' => ["tire_model_example1.jpeg", "tire_model_example2.jpg", "tire_model_example3.jpg"]
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(TireModel $tireModel) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireModel::class;
    }
}
