<?php

declare(strict_types=1);

namespace Tests\MangoSylius\SortingPlugin\Behat\Pages\Admin\Sorting;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;

interface SortingPageInterface extends SymfonyPageInterface
{
	public function saveSorting();

	public function getPosition($arg1, int $int);

	public function getState($arg1);
}
