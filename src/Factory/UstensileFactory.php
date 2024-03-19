<?php

namespace App\Factory;

use App\Entity\Ustensile;
use App\Repository\UstensileRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Ustensile>
 *
 * @method        Ustensile|Proxy                     create(array|callable $attributes = [])
 * @method static Ustensile|Proxy                     createOne(array $attributes = [])
 * @method static Ustensile|Proxy                     find(object|array|mixed $criteria)
 * @method static Ustensile|Proxy                     findOrCreate(array $attributes)
 * @method static Ustensile|Proxy                     first(string $sortedField = 'id')
 * @method static Ustensile|Proxy                     last(string $sortedField = 'id')
 * @method static Ustensile|Proxy                     random(array $attributes = [])
 * @method static Ustensile|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UstensileRepository|RepositoryProxy repository()
 * @method static Ustensile[]|Proxy[]                 all()
 * @method static Ustensile[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Ustensile[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Ustensile[]|Proxy[]                 findBy(array $attributes)
 * @method static Ustensile[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Ustensile[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UstensileFactory extends ModelFactory
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
        $imgUs = self::faker()->image(sys_get_temp_dir(), 150, 150, 'food', true, true, 'kitchen');

        return [
            'nomUs' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
            'imgUs' => file_get_contents($imgUs),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Ustensile $ustensile): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ustensile::class;
    }
}
