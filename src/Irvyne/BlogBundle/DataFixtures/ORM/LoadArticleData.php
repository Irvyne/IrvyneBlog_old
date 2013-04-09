<?php

namespace Irvyne\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Irvyne\BlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
         * Article 1
         */
        $articleBlog = new Article();
        $articleBlog->setTitle('Why a blog with Symfony2 ?');
        $articleBlog->setSummary('<p>Wordpress is the best for blog site but I would try to do just what I need with a very speed up website !</p>');
        $articleBlog->setContent('<p>In the IT world, it is not rare occurrence for people to become concerned with the performance of an application… once they reach the end of the project! That is, once everything has been designed at both the functional and the technology levels. And unless you take everything apart again, performance optimization is not exactly an easy task.</p><p>On the other hand, Symfony2 was conceived from the start to be fast and to favor performance. By way of comparison, Symfony2 is about 3 times faster than Version 1.4 or than Zend Framework 1.10, while taking up 2 times less memory.</p>');
        $articleBlog->setTranslatableLocale('en');
        $manager->persist($articleBlog);

        /**
         * Article 2
         */
        $articleSymfony2 = new Article();
        $articleSymfony2->setTitle('Symfony is a PHP framework for web projects.');
        $articleSymfony2->setSummary('<p>Speed up the creation and maintenance of your PHP web applications.</p>');
        $articleSymfony2->setContent('<p>Speed up the creation and maintenance of your PHP web applications. Replace the repetitive coding tasks by power, control and pleasure.</p>');
        $articleSymfony2->setTranslatableLocale('en');
        $manager->persist($articleSymfony2);

        $manager->flush();

        $this->addReference('articleBlog',      $articleBlog);
        $this->addReference('articleSymfony2',  $articleSymfony2);
    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}