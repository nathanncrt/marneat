<?php

namespace App\Factory;

use App\Entity\Allergene;
use App\Repository\AllergeneRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Allergene>
 *
 * @method        Allergene|Proxy                     create(array|callable $attributes = [])
 * @method static Allergene|Proxy                     createOne(array $attributes = [])
 * @method static Allergene|Proxy                     find(object|array|mixed $criteria)
 * @method static Allergene|Proxy                     findOrCreate(array $attributes)
 * @method static Allergene|Proxy                     first(string $sortedField = 'id')
 * @method static Allergene|Proxy                     last(string $sortedField = 'id')
 * @method static Allergene|Proxy                     random(array $attributes = [])
 * @method static Allergene|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AllergeneRepository|RepositoryProxy repository()
 * @method static Allergene[]|Proxy[]                 all()
 * @method static Allergene[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Allergene[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Allergene[]|Proxy[]                 findBy(array $attributes)
 * @method static Allergene[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Allergene[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AllergeneFactory extends ModelFactory
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
            'libAll' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
            'descAll' => self::faker()->text(1000),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Allergene $allergene): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Allergene::class;
    }
}
