<?php

declare(strict_types=1);

namespace AppBundle\EventListener;

use EzSystems\EzPlatformAdminUi\Menu\Event\ConfigureMenuEvent;
use EzSystems\EzPlatformAdminUi\Menu\MainMenuBuilder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Menu class extending Admin UI's KNPMenu based menu system.
 */
class MyAdminUIMenuListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents() : array
    {
        return [
            ConfigureMenuEvent::MAIN_MENU => 'onMenuConfigure',
        ];
    }

    public function onMenuConfigure(ConfigureMenuEvent $event) : void
    {
        $menu = $event->getMenu();

        // Add own top level section
        $menu->addChild(
            //aria-controls attribute
            'my_menu_item',
            [
                'label' => 'My Menu Item',
                'linkAttributes' => [
                    'class' => 'test_class another_class',
                    'data-property' => 'value',
                ],
            ]
        );
        $menu['menu_item_1']->addChild(
            //aria-controls attribute
            '2nd_level_menu_item_link_to_ez_no',
            [
                'label' => 'ez.no',
                'uri' => 'http://ez.no',
            ]
        );

        // Add sub section under content
        $menu[MainMenuBuilder::ITEM_CONTENT]->addChild(
            //aria-controls attribute
            'setup_menu',
            [
                'label' => 'setup.translation.key',
                'route' => '_ezpublishLocation',
                'routeParameters' => ['locationId' => 48],
                'linkAttributes' => [
                    'class' => 'test_class another_class',
                    'data-property' => 'value',
                ],
                'extras' => [
                    'translation_domain' => 'messages',
                ],
            ]
        );
        //output example after label translation:
        //<a href="/admin/content/location/48" aria-controls="setup_menu" data-property="value" class="nav-link test_class another_class">Setup</a>
    }
}
