<?php

namespace ToBeDoneBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ToBeDoneBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('a@a.com');
        $userAdmin->setIsActive(true);
        $adminPassword = $this->container
            ->get('security.password_encoder')
            ->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($adminPassword);

        $manager->persist($userAdmin);
        $manager->flush();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}