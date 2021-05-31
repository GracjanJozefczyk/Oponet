<?php

namespace App\Factory;

use App\Entity\Tire\TireLoadIndex;
use App\Repository\Tire\TireLoadIndexRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireLoadIndex|Proxy createOne(array $attributes = [])
 * @method static TireLoadIndex[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireLoadIndex|Proxy find($criteria)
 * @method static TireLoadIndex|Proxy findOrCreate(array $attributes)
 * @method static TireLoadIndex|Proxy first(string $sortedField = 'id')
 * @method static TireLoadIndex|Proxy last(string $sortedField = 'id')
 * @method static TireLoadIndex|Proxy random(array $attributes = [])
 * @method static TireLoadIndex|Proxy randomOrCreate(array $attributes = [])
 * @method static TireLoadIndex[]|Proxy[] all()
 * @method static TireLoadIndex[]|Proxy[] findBy(array $attributes)
 * @method static TireLoadIndex[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireLoadIndex[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireLoadIndexRepository|RepositoryProxy repository()
 * @method TireLoadIndex|Proxy create($attributes = [])
 */
final class TireLoadIndexFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireLoadIndex $tireLoadIndex) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireLoadIndex::class;
    }
}
