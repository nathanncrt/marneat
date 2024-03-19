<?php

namespace App\Factory;

use App\Entity\FamilleIngredient;
use App\Repository\FamilleIngredientRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<FamilleIngredient>
 *
 * @method        FamilleIngredient|Proxy                     create(array|callable $attributes = [])
 * @method static FamilleIngredient|Proxy                     createOne(array $attributes = [])
 * @method static FamilleIngredient|Proxy                     find(object|array|mixed $criteria)
 * @method static FamilleIngredient|Proxy                     findOrCreate(array $attributes)
 * @method static FamilleIngredient|Proxy                     first(string $sortedField = 'id')
 * @method static FamilleIngredient|Proxy                     last(string $sortedField = 'id')
 * @method static FamilleIngredient|Proxy                     random(array $attributes = [])
 * @method static FamilleIngredient|Proxy                     randomOrCreate(array $attributes = [])
 * @method static FamilleIngredientRepository|RepositoryProxy repository()
 * @method static FamilleIngredient[]|Proxy[]                 all()
 * @method static FamilleIngredient[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static FamilleIngredient[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static FamilleIngredient[]|Proxy[]                 findBy(array $attributes)
 * @method static FamilleIngredient[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static FamilleIngredient[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class FamilleIngredientFactory extends ModelFactory
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
            'libFamIng' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(FamilleIngredient $familleIngredient): void {})
        ;
    }

    protected static function getClass(): string
    {
        return FamilleIngredient::class;
    }
}
