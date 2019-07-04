<?php

declare(strict_types=1);

namespace MangoSylius\SortingPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class SortingMenuBuilder
{
	public function buildMenu(MenuBuilderEvent $event): void
	{
		$sales = $event
			->getMenu()
			->getChild('catalog');

		if ($sales !== null) {
			$sales
				->addChild('sorting', [
					'route' => 'mango_sylius_admin_sorting_index',
				])
				->setName('mango-sylius.ui.sortingPlugin.menuTitle')
				->setLabelAttribute('icon', 'sort');
		}
	}
}
