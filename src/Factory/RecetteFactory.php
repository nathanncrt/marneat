<?php

namespace App\Factory;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recette>
 *
 * @method        Recette|Proxy                     create(array|callable $attributes = [])
 * @method static Recette|Proxy                     createOne(array $attributes = [])
 * @method static Recette|Proxy                     find(object|array|mixed $criteria)
 * @method static Recette|Proxy                     findOrCreate(array $attributes)
 * @method static Recette|Proxy                     first(string $sortedField = 'id')
 * @method static Recette|Proxy                     last(string $sortedField = 'id')
 * @method static Recette|Proxy                     random(array $attributes = [])
 * @method static Recette|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RecetteRepository|RepositoryProxy repository()
 * @method static Recette[]|Proxy[]                 all()
 * @method static Recette[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Recette[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Recette[]|Proxy[]                 findBy(array $attributes)
 * @method static Recette[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Recette[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RecetteFactory extends ModelFactory
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
        $affiche = self::faker()->image(sys_get_temp_dir(), 150, 150);

        return [
            'datePubli' => self::faker()->dateTime(),
            'nomRecette' => mb_convert_case(self::faker()->word().self::faker()->word().self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
            'tpsPrepa' => self::faker()->dateTime(),
            'tpsCuisson' => self::faker()->dateTime(),
            'tpsRepos' => self::faker()->dateTime(),
            'descRecette' => self::faker()->text(1500),
            'affiche' => file_get_contents($affiche),
            'nb_pers' => self::faker()->numberBetween(1, 10),
            'difficulte' => self::faker()->numberBetween(1, 5),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Recette $recette): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Recette::class;
    }
}
