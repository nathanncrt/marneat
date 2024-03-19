<?php

namespace App\Factory;

use App\Entity\Noter;
use App\Repository\NoterRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Noter>
 *
 * @method        Noter|Proxy                     create(array|callable $attributes = [])
 * @method static Noter|Proxy                     createOne(array $attributes = [])
 * @method static Noter|Proxy                     find(object|array|mixed $criteria)
 * @method static Noter|Proxy                     findOrCreate(array $attributes)
 * @method static Noter|Proxy                     first(string $sortedField = 'id')
 * @method static Noter|Proxy                     last(string $sortedField = 'id')
 * @method static Noter|Proxy                     random(array $attributes = [])
 * @method static Noter|Proxy                     randomOrCreate(array $attributes = [])
 * @method static NoterRepository|RepositoryProxy repository()
 * @method static Noter[]|Proxy[]                 all()
 * @method static Noter[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Noter[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Noter[]|Proxy[]                 findBy(array $attributes)
 * @method static Noter[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Noter[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class NoterFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'note' => self::faker()->randomFloat(2, 1, 5),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Noter $noter): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Noter::class;
    }
}
