<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Ottaviano\Faker\Gravatar;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<User>
 *
 * @method        User|Proxy                     create(array|callable $attributes = [])
 * @method static User|Proxy                     createOne(array $attributes = [])
 * @method static User|Proxy                     find(object|array|mixed $criteria)
 * @method static User|Proxy                     findOrCreate(array $attributes)
 * @method static User|Proxy                     first(string $sortedField = 'id')
 * @method static User|Proxy                     last(string $sortedField = 'id')
 * @method static User|Proxy                     random(array $attributes = [])
 * @method static User|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static User[]|Proxy[]                 all()
 * @method static User[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static User[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static User[]|Proxy[]                 findBy(array $attributes)
 * @method static User[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static User[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    private \Transliterator $transliterator;

    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->transliterator = \Transliterator::create('Any-Lower; Latin-ASCII');
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $dateBirth = self::faker()->dateTime();
        $firstname = $this->normalizeName(self::faker()->firstName());
        $lastname = $this->normalizeName(self::faker()->lastName());
        $predomain = "$firstname.$lastname";
        $email = $predomain.'@'.self::faker()->domainName();
        $password = self::faker()->password(12, 30); // Minimum de 12 caractères pour un mot de passe à ne pas oublier dans le formulaire
        $phone = $this->cleanPhoneNumber(self::faker()->serviceNumber());
        $postalCode = self::faker()->numerify('#####');
        $username = self::faker()->userName();
        $address = self::faker()->address();
        $city = self::faker()->city();
        $avatar = file_get_contents(Gravatar::gravatar());

        return [
            'dateNais' => $dateBirth,
            'emailPers' => $email,
            'nomPers' => $lastname,
            'password' => $password,
            'pnomPers' => $firstname,
            'roles' => ['ROLE_USER'],
            'username' => $username,
            'telPers' => $phone,
            'cpPers' => $postalCode,
            'adrPers' => $address,
            'villePers' => $city,
            'avatar' => $avatar,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (User $user) {
                $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }

    protected function normalizeName(string $firstnameLastname): array|string|null
    {
        $temp = $this->transliterator->transliterate($firstnameLastname);

        $normalizename = mb_strtolower($temp);

        return preg_replace('/[^a-z]/', '-', $normalizename);
    }

    protected function cleanPhoneNumber(string $phoneNumber): string
    {
        // Supprimer tous les caractères non numériques du numéro de téléphone
        $cleaned = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Tronquer le numéro à 10 caractères s'il est plus long
        $trimmed = substr($cleaned, 0, 10);

        return $trimmed;
    }
}
