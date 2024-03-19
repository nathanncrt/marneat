<?php

namespace App\Factory;

use App\Entity\SousCategorieRecette;
use App\Repository\SousCategorieRecetteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SousCategorieRecette>
 *
 * @method        SousCategorieRecette|Proxy                     create(array|callable $attributes = [])
 * @method static SousCategorieRecette|Proxy                     createOne(array $attributes = [])
 * @method static SousCategorieRecette|Proxy                     find(object|array|mixed $criteria)
 * @method static SousCategorieRecette|Proxy                     findOrCreate(array $attributes)
 * @method static SousCategorieRecette|Proxy                     first(string $sortedField = 'id')
 * @method static SousCategorieRecette|Proxy                     last(string $sortedField = 'id')
 * @method static SousCategorieRecette|Proxy                     random(array $attributes = [])
 * @method static SousCategorieRecette|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SousCategorieRecetteRepository|RepositoryProxy repository()
 * @method static SousCategorieRecette[]|Proxy[]                 all()
 * @method static SousCategorieRecette[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static SousCategorieRecette[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static SousCategorieRecette[]|Proxy[]                 findBy(array $attributes)
 * @method static SousCategorieRecette[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static SousCategorieRecette[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SousCategorieRecetteFactory extends ModelFactory
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
            'libSousCategorieRecette' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SousCategorieRecette $sousCategorieRecette): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SousCategorieRecette::class;
    }
}
