<?php

namespace Irvyne\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class BackendNavbarMenuBuilder extends AbstractNavbarMenuBuilder
{
    protected $securityContext;
    protected $isLoggedIn;

    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        parent::__construct($factory);

        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        $menu->addChild('Articles', array('route' => 'article'));
        $menu->addChild('Categories', array('route' => 'category'));

        $menu->addChild('Login', array('route' => 'fos_user_security_login', 'class' => 'pull-right'));
        /**
         * TODO Language Switcher
         */
        /*
        $dropdown = $this->createDropdownMenuItem($menu, 'Language Switcher');
        $dropdown->addChild('English');
        $dropdown->addChild('French');
        {% for locale in ['en', 'fr'] %}
            <li {% if locale == app.request.locale %}class="active"{% endif %}>
                <a href="{{ path(app.request.get('_route'), app.request.get('_route_params')|merge({'_locale' : locale})) }}">{{ locale }}</a>
            </li>
        {% endfor %}
        */
        /*
        $dropdown = $this->createDropdownMenuItem($menu, "Mehr");
        $dropdown->addChild('Captain Ränge', array('route' => 'article'));
        $dropdown->addChild('Schiffs-XP', array('route' => 'category'));
        */

        return $menu;
    }

    public function createRightMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        $menu->addChild('Login', array('route' => 'fos_user_security_login'));
        $menu->addChild('Register', array('route' => 'fos_user_registration_register'));

        return $menu;
    }
}