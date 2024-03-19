<?php

namespace App\Factory;

use App\Entity\Contenir;
use App\Repository\ContenirRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Contenir>
 *
 * @method        Contenir|Proxy                     create(array|callable $attributes = [])
 * @method static Contenir|Proxy                     createOne(array $attributes = [])
 * @method static Contenir|Proxy                     find(object|array|mixed $criteria)
 * @method static Contenir|Proxy                     findOrCreate(array $attributes)
 * @method static Contenir|Proxy                     first(string $sortedField = 'id')
 * @method static Contenir|Proxy                     last(string $sortedField = 'id')
 * @method static Contenir|Proxy                     random(array $attributes = [])
 * @method static Contenir|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ContenirRepository|RepositoryProxy repository()
 * @method static Contenir[]|Proxy[]                 all()
 * @method static Contenir[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Contenir[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Contenir[]|Proxy[]                 findBy(array $attributes)
 * @method static Contenir[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Contenir[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ContenirFactory extends ModelFactory
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
            'qteIngredients' => self::faker()->randomFloat(2, 1, 10),
            // Voir plus tard pour générer aléatoirement un code d'Unité de Mesure
            'uniteMesure' => self::faker()->text(5),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Contenir $contenir): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Contenir::class;
    }
}
