<?php

namespace App\Factory;

use App\Entity\SousFamilleIngredient;
use App\Repository\SousFamilleIngredientRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SousFamilleIngredient>
 *
 * @method        SousFamilleIngredient|Proxy                     create(array|callable $attributes = [])
 * @method static SousFamilleIngredient|Proxy                     createOne(array $attributes = [])
 * @method static SousFamilleIngredient|Proxy                     find(object|array|mixed $criteria)
 * @method static SousFamilleIngredient|Proxy                     findOrCreate(array $attributes)
 * @method static SousFamilleIngredient|Proxy                     first(string $sortedField = 'id')
 * @method static SousFamilleIngredient|Proxy                     last(string $sortedField = 'id')
 * @method static SousFamilleIngredient|Proxy                     random(array $attributes = [])
 * @method static SousFamilleIngredient|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SousFamilleIngredientRepository|RepositoryProxy repository()
 * @method static SousFamilleIngredient[]|Proxy[]                 all()
 * @method static SousFamilleIngredient[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static SousFamilleIngredient[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static SousFamilleIngredient[]|Proxy[]                 findBy(array $attributes)
 * @method static SousFamilleIngredient[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static SousFamilleIngredient[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SousFamilleIngredientFactory extends ModelFactory
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
            'libSousFamImg' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SousFamilleIngredient $sousFamilleIngredient): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SousFamilleIngredient::class;
    }
}
