<?php

namespace App\Factory;

use App\Entity\Commenter;
use App\Repository\CommenterRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Commenter>
 *
 * @method        Commenter|Proxy                     create(array|callable $attributes = [])
 * @method static Commenter|Proxy                     createOne(array $attributes = [])
 * @method static Commenter|Proxy                     find(object|array|mixed $criteria)
 * @method static Commenter|Proxy                     findOrCreate(array $attributes)
 * @method static Commenter|Proxy                     first(string $sortedField = 'id')
 * @method static Commenter|Proxy                     last(string $sortedField = 'id')
 * @method static Commenter|Proxy                     random(array $attributes = [])
 * @method static Commenter|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CommenterRepository|RepositoryProxy repository()
 * @method static Commenter[]|Proxy[]                 all()
 * @method static Commenter[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Commenter[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Commenter[]|Proxy[]                 findBy(array $attributes)
 * @method static Commenter[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Commenter[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CommenterFactory extends ModelFactory
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
            'textComm' => self::faker()->text(1000),
            // Pour plus tard : faire une condition afin que la date de publication
            // du commentaire soit strictement supérieur ou égale à la date
            // de publication de la recette
            'datePubli' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Commenter $commenter): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Commenter::class;
    }
}
