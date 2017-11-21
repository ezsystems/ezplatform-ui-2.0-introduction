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
            'menu_item_1',
            ['label' => 'My Menu Item']
        );
        $menu['menu_item_1']->addChild(
            '2nd_level_menu_item',
            [
                // Example of trnslating menu items
                //'label' => 'translation.key',
                //'translation_domain' => 'messages',
                'label' => 'ez.no',
                'uri' => 'http://ez.no',
            ]
        );

        // Add sub section under content
        $menu[MainMenuBuilder::ITEM_CONTENT]->addChild(
            'setup_node',
            [
                'label' => 'Setup',
                'route' => '_ezpublishLocation',
                'routeParameters' => ['locationId' => 48],
                [
                    // Example of configutng look on menu item
                    'linkAttributes' => [
                        'class' => 'test_class another_class',
                        'data-property' => 'value',
                    ],
                ],
            ]
        );
    }
}
