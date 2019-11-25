<?php

declare(strict_types=1);

namespace Tests\MangoSylius\SortingPlugin\Behat\Pages\Admin\Sorting;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

final class SortingPage extends SymfonyPage implements SortingPageInterface
{
	public function getRouteName(): string
	{
		return 'mango_sylius_admin_sorting_products';
	}

	public function saveSorting(): void
	{
		$this->getElement('save_sorting')->click();
	}

	protected function getDefinedElements(): array
	{
		return array_merge(parent::getDefinedElements(), [
			'save_sorting' => 'button:contains("Save positions")',
		]);
	}

	public function getPosition($arg1, int $int)
	{
		$Page = $this->getSession()->getPage();
		$firstE = $Page->find('css', '#sortableProducts .sortableItem:nth-child(' . $int . ') .content .header')->getText();
		if ($firstE != $arg1) {
			throw new \RuntimeException(sprintf($firstE));
		}
	}

	public function getState($arg1)
	{
		$Page = $this->getSession()->getPage();
		$elementA = $Page->find('css', '#sortableProducts .sortableItem:nth-child(1)')->getHtml();
		if (strpos($elementA, 'style="opacity: 0.5') == false) {
			throw new \RuntimeException(sprintf($elementA));
		}
	}
}
