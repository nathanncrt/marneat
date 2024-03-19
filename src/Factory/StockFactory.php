<?php

namespace App\Factory;

use App\Entity\Stock;
use App\Repository\StockRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Stock>
 *
 * @method        Stock|Proxy                     create(array|callable $attributes = [])
 * @method static Stock|Proxy                     createOne(array $attributes = [])
 * @method static Stock|Proxy                     find(object|array|mixed $criteria)
 * @method static Stock|Proxy                     findOrCreate(array $attributes)
 * @method static Stock|Proxy                     first(string $sortedField = 'id')
 * @method static Stock|Proxy                     last(string $sortedField = 'id')
 * @method static Stock|Proxy                     random(array $attributes = [])
 * @method static Stock|Proxy                     randomOrCreate(array $attributes = [])
 * @method static StockRepository|RepositoryProxy repository()
 * @method static Stock[]|Proxy[]                 all()
 * @method static Stock[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Stock[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Stock[]|Proxy[]                 findBy(array $attributes)
 * @method static Stock[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Stock[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class StockFactory extends ModelFactory
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
            'qteDispo' => self::faker()->randomFloat(),
            'uniteMesure' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Stock $stock): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Stock::class;
    }
}
