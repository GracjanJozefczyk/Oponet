<?php

namespace App\Factory;

use App\Entity\Tire\TireRimSize;
use App\Repository\Tire\TireRimSizeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireRimSize|Proxy createOne(array $attributes = [])
 * @method static TireRimSize[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireRimSize|Proxy find($criteria)
 * @method static TireRimSize|Proxy findOrCreate(array $attributes)
 * @method static TireRimSize|Proxy first(string $sortedField = 'id')
 * @method static TireRimSize|Proxy last(string $sortedField = 'id')
 * @method static TireRimSize|Proxy random(array $attributes = [])
 * @method static TireRimSize|Proxy randomOrCreate(array $attributes = [])
 * @method static TireRimSize[]|Proxy[] all()
 * @method static TireRimSize[]|Proxy[] findBy(array $attributes)
 * @method static TireRimSize[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireRimSize[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireRimSizeRepository|RepositoryProxy repository()
 * @method TireRimSize|Proxy create($attributes = [])
 */
final class TireRimSizeFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireRimSize $tireRimSize) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireRimSize::class;
    }
}
