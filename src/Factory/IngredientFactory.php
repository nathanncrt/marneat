<?php

namespace App\Factory;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Ingredient>
 *
 * @method        Ingredient|Proxy                     create(array|callable $attributes = [])
 * @method static Ingredient|Proxy                     createOne(array $attributes = [])
 * @method static Ingredient|Proxy                     find(object|array|mixed $criteria)
 * @method static Ingredient|Proxy                     findOrCreate(array $attributes)
 * @method static Ingredient|Proxy                     first(string $sortedField = 'id')
 * @method static Ingredient|Proxy                     last(string $sortedField = 'id')
 * @method static Ingredient|Proxy                     random(array $attributes = [])
 * @method static Ingredient|Proxy                     randomOrCreate(array $attributes = [])
 * @method static IngredientRepository|RepositoryProxy repository()
 * @method static Ingredient[]|Proxy[]                 all()
 * @method static Ingredient[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Ingredient[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Ingredient[]|Proxy[]                 findBy(array $attributes)
 * @method static Ingredient[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Ingredient[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class IngredientFactory extends ModelFactory
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
        $img = self::faker()->image(sys_get_temp_dir(), 150, 150);
        return [
            'nomIng' => mb_convert_case(self::faker()->word().self::faker()->word().self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
            'imgIng' => self::faker()->boolean(35) ? file_get_contents($img) : null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Ingredient $ingredient): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ingredient::class;
    }
}
