<?php

namespace App\Factory;

use App\Entity\CategorieRecette;
use App\Repository\CategorieRecetteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CategorieRecette>
 *
 * @method        CategorieRecette|Proxy                     create(array|callable $attributes = [])
 * @method static CategorieRecette|Proxy                     createOne(array $attributes = [])
 * @method static CategorieRecette|Proxy                     find(object|array|mixed $criteria)
 * @method static CategorieRecette|Proxy                     findOrCreate(array $attributes)
 * @method static CategorieRecette|Proxy                     first(string $sortedField = 'id')
 * @method static CategorieRecette|Proxy                     last(string $sortedField = 'id')
 * @method static CategorieRecette|Proxy                     random(array $attributes = [])
 * @method static CategorieRecette|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CategorieRecetteRepository|RepositoryProxy repository()
 * @method static CategorieRecette[]|Proxy[]                 all()
 * @method static CategorieRecette[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static CategorieRecette[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static CategorieRecette[]|Proxy[]                 findBy(array $attributes)
 * @method static CategorieRecette[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static CategorieRecette[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CategorieRecetteFactory extends ModelFactory
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
            'libCatRecette' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CategorieRecette $categorieRecette): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CategorieRecette::class;
    }
}
