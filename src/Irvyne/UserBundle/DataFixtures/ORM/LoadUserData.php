<?php

namespace Irvyne\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Irvyne\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('irvyne');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEmail('admin@domain.com');
        $userAdmin->setSuperAdmin(true);
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();

        $this->addReference('userAdmin', $userAdmin);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}