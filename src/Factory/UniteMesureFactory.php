<?php

namespace App\Factory;

use App\Entity\UniteMesure;
use App\Repository\UniteMesureRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<UniteMesure>
 *
 * @method        UniteMesure|Proxy                     create(array|callable $attributes = [])
 * @method static UniteMesure|Proxy                     createOne(array $attributes = [])
 * @method static UniteMesure|Proxy                     find(object|array|mixed $criteria)
 * @method static UniteMesure|Proxy                     findOrCreate(array $attributes)
 * @method static UniteMesure|Proxy                     first(string $sortedField = 'id')
 * @method static UniteMesure|Proxy                     last(string $sortedField = 'id')
 * @method static UniteMesure|Proxy                     random(array $attributes = [])
 * @method static UniteMesure|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UniteMesureRepository|RepositoryProxy repository()
 * @method static UniteMesure[]|Proxy[]                 all()
 * @method static UniteMesure[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static UniteMesure[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static UniteMesure[]|Proxy[]                 findBy(array $attributes)
 * @method static UniteMesure[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static UniteMesure[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UniteMesureFactory extends ModelFactory
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
            'codeUm' => self::faker()->text(5),
            'libUm' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(UniteMesure $uniteMesure): void {})
        ;
    }

    protected static function getClass(): string
    {
        return UniteMesure::class;
    }
}
