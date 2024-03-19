<?php

namespace App\Factory;

use App\Entity\ImageRecette;
use App\Repository\ImageRecetteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ImageRecette>
 *
 * @method        ImageRecette|Proxy                     create(array|callable $attributes = [])
 * @method static ImageRecette|Proxy                     createOne(array $attributes = [])
 * @method static ImageRecette|Proxy                     find(object|array|mixed $criteria)
 * @method static ImageRecette|Proxy                     findOrCreate(array $attributes)
 * @method static ImageRecette|Proxy                     first(string $sortedField = 'id')
 * @method static ImageRecette|Proxy                     last(string $sortedField = 'id')
 * @method static ImageRecette|Proxy                     random(array $attributes = [])
 * @method static ImageRecette|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ImageRecetteRepository|RepositoryProxy repository()
 * @method static ImageRecette[]|Proxy[]                 all()
 * @method static ImageRecette[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static ImageRecette[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static ImageRecette[]|Proxy[]                 findBy(array $attributes)
 * @method static ImageRecette[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static ImageRecette[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ImageRecetteFactory extends ModelFactory
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
        $jpeg = self::faker()->image(sys_get_temp_dir(), 150, 150);

        return [
            'jpeg' => file_get_contents($jpeg),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ImageRecette $imageRecette): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ImageRecette::class;
    }
}
