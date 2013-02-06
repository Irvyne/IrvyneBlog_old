<?php

namespace Irvyne\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IrvyneUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
