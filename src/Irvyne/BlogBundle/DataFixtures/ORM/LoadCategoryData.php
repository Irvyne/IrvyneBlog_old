<?php

namespace Irvyne\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Irvyne\BlogBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        /**
         * Level 1
         */
        $categoryDevelopment = new Category();
        $categoryDevelopment->setName('Development');
        $categoryDevelopment->setDescription('Development');
        $categoryDevelopment->setTranslatableLocale('en');
        $manager->persist($categoryDevelopment);
        /**
         * Level 2
         */
        $categoryPHP = new Category();
        $categoryPHP->setName('PHP');
        $categoryPHP->setDescription('PHP');
        $categoryPHP->setParent($categoryDevelopment);
        $categoryPHP->setTranslatableLocale('en');
        $manager->persist($categoryPHP);
        /**
         * Level 3
         */
        $categorySymfony2 = new Category();
        $categorySymfony2->setName('Symfony 2');
        $categorySymfony2->setDescription('Symfony 2');
        $categorySymfony2->setParent($categoryDevelopment);
        $categorySymfony2->setTranslatableLocale('en');
        $manager->persist($categorySymfony2);

        $manager->flush();

        $this->addReference('categoryDevelopment', $categoryDevelopment);
        $this->addReference('categoryPHP', $categoryPHP);
        $this->addReference('categorySymfony2', $categorySymfony2);
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}