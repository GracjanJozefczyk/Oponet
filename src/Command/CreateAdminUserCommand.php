<?php

namespace App\Command;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAdminUserCommand extends Command
{
    protected static $defaultName = 'app:create-admin-user';
    protected static $defaultDescription = 'Add new user with role admin';

    private $passwordEncoder;
    private $em;
    private $parameterBagInterface;
    private $validatorInterface;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, ParameterBagInterface $parameterBagInterface, ValidatorInterface $validatorInterface)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
        $this->parameterBagInterface = $parameterBagInterface;
        $this->validatorInterface = $validatorInterface;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('USER MAKER - create new user');

        $roles = array_keys($this->parameterBagInterface->get('security.role_hierarchy.roles'));
        $role[] = $io->choice('Select user role', $roles);

        $io->note('It will be used to log-in');
        $email = $io->ask('Enter email: ');

        $password = $io->askHidden('Enter password: ');
        $passwordConfirm = $io->askHidden('Confirm password: ');

        if ($password === $passwordConfirm) {
            $user = new User();
            $user->setEmail($email);
            $user->setRoles($role);
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, $password)
            );

            $errors = $this->validatorInterface->validate($user);
            if (count($errors) > 0 ) {
                throw new \RuntimeException((string) $errors);
            } else {
                $this->em->persist($user);
                $this->em->flush();
            }
        } else {
            throw new \RuntimeException('Passwords are not the same!');
        }

        $io->success(sprintf('User %s has been created!', $email));

        return 0;
    }
}
