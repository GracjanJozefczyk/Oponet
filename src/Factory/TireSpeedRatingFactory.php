<?php

namespace App\Factory;

use App\Entity\Tire\TireSpeedRating;
use App\Repository\Tire\TireSpeedRatingRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static TireSpeedRating|Proxy createOne(array $attributes = [])
 * @method static TireSpeedRating[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static TireSpeedRating|Proxy find($criteria)
 * @method static TireSpeedRating|Proxy findOrCreate(array $attributes)
 * @method static TireSpeedRating|Proxy first(string $sortedField = 'id')
 * @method static TireSpeedRating|Proxy last(string $sortedField = 'id')
 * @method static TireSpeedRating|Proxy random(array $attributes = [])
 * @method static TireSpeedRating|Proxy randomOrCreate(array $attributes = [])
 * @method static TireSpeedRating[]|Proxy[] all()
 * @method static TireSpeedRating[]|Proxy[] findBy(array $attributes)
 * @method static TireSpeedRating[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static TireSpeedRating[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TireSpeedRatingRepository|RepositoryProxy repository()
 * @method TireSpeedRating|Proxy create($attributes = [])
 */
final class TireSpeedRatingFactory extends ModelFactory
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
            // ->afterInstantiate(function(TireSpeedRating $tireSpeedRating) {})
        ;
    }

    protected static function getClass(): string
    {
        return TireSpeedRating::class;
    }
}
