<?php

namespace App\Factory;

use App\Entity\Section;
use App\Repository\SectionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Section>
 *
 * @method        Section|Proxy                     create(array|callable $attributes = [])
 * @method static Section|Proxy                     createOne(array $attributes = [])
 * @method static Section|Proxy                     find(object|array|mixed $criteria)
 * @method static Section|Proxy                     findOrCreate(array $attributes)
 * @method static Section|Proxy                     first(string $sortedField = 'id')
 * @method static Section|Proxy                     last(string $sortedField = 'id')
 * @method static Section|Proxy                     random(array $attributes = [])
 * @method static Section|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SectionRepository|RepositoryProxy repository()
 * @method static Section[]|Proxy[]                 all()
 * @method static Section[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Section[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Section[]|Proxy[]                 findBy(array $attributes)
 * @method static Section[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Section[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SectionFactory extends ModelFactory
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
            'libSec' => mb_convert_case(self::faker()->word(), MB_CASE_TITLE, 'UTF-8'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Section $section): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Section::class;
    }
}
