<?php

namespace App\Factory;

use App\Entity\Etape;
use App\Repository\EtapeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Etape>
 *
 * @method        Etape|Proxy                     create(array|callable $attributes = [])
 * @method static Etape|Proxy                     createOne(array $attributes = [])
 * @method static Etape|Proxy                     find(object|array|mixed $criteria)
 * @method static Etape|Proxy                     findOrCreate(array $attributes)
 * @method static Etape|Proxy                     first(string $sortedField = 'id')
 * @method static Etape|Proxy                     last(string $sortedField = 'id')
 * @method static Etape|Proxy                     random(array $attributes = [])
 * @method static Etape|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EtapeRepository|RepositoryProxy repository()
 * @method static Etape[]|Proxy[]                 all()
 * @method static Etape[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Etape[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Etape[]|Proxy[]                 findBy(array $attributes)
 * @method static Etape[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Etape[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EtapeFactory extends ModelFactory
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
            'numEtape' => self::faker()->randomNumber(),
            'descEtape' => self::faker()->text(1000),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Etape $etape): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Etape::class;
    }
}
