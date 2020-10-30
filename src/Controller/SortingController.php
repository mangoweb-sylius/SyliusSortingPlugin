<?php

declare(strict_types=1);

namespace MangoSylius\SortingPlugin\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Core\Model\ProductTaxonInterface;
use Sylius\Component\Core\Repository\ProductTaxonRepositoryInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class SortingController
{
	/** @var EngineInterface */
	private $templatingEngine;
	/**
	 * @var TaxonRepositoryInterface
	 */
	private $taxonRepository;
	/**
	 * @var ProductTaxonRepositoryInterface
	 */
	private $productTaxonRepository;
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;
	/**
	 * @var EventDispatcherInterface
	 */
	private $eventDispatcher;
	/**
	 * @var RouterInterface
	 */
	private $router;
	/**
	 * @var FlashBagInterface
	 */
	private $flashBag;
	/**
	 * @var TranslatorInterface
	 */
	private $translator;

	public function __construct(
		EngineInterface $templatingEngine,
		TaxonRepositoryInterface $taxonRepository,
		ProductTaxonRepositoryInterface $productTaxonRepository,
		EntityManagerInterface $entityManager,
		EventDispatcherInterface $eventDispatcher,
		RouterInterface $router,
		FlashBagInterface $flashBag,
		TranslatorInterface $translator
	) {
		$this->templatingEngine = $templatingEngine;
		$this->taxonRepository = $taxonRepository;
		$this->productTaxonRepository = $productTaxonRepository;
		$this->entityManager = $entityManager;
		$this->eventDispatcher = $eventDispatcher;
		$this->router = $router;
		$this->flashBag = $flashBag;
		$this->translator = $translator;
	}

	public function index(): Response
	{
		return new Response(
			$this->templatingEngine->render(
				'@MangoSyliusSortingPlugin/index.html.twig'
			)
		);
	}

	public function products(int $taxonId): Response
	{
		$taxon = $this->taxonRepository->find($taxonId);
		if ($taxon === null) {
			throw new NotFoundHttpException();
		}

		$productsTaxons = $this->productTaxonRepository->findBy(
			['taxon' => $taxon],
			['position' => 'asc']
		);

		return new Response(
			$this->templatingEngine->render(
				'@MangoSyliusSortingPlugin/index.html.twig',
				[
					'taxon' => $taxon,
					'productsTaxons' => $productsTaxons,
				]
			)
		);
	}

	public function savePositions(Request $request): RedirectResponse
	{
		$taxon = null;

		if ($request->request->get('id') !== null) {
			foreach ($request->request->get('id') as $i => $id) {
				$productTaxon = $this->productTaxonRepository->find($id);
				assert($productTaxon instanceof ProductTaxonInterface);
				$productTaxon->setPosition($i);

				if ($taxon === null) {
					$taxon = $productTaxon->getTaxon();
				}
				
				$this->entityManager->flush();
			}
		}

		if ($taxon !== null) {
			$message = $this->translator->trans('mango-sylius.ui.sortingPlugin.successMessage');
			$this->flashBag->add('success', $message);

			$redirectUrl = $this->router->generate('mango_sylius_admin_sorting_products', ['taxonId' => $taxon->getId()]);

			// Eg. for update product position in elasticsearch
			$event = new GenericEvent($taxon);
			$this->eventDispatcher->dispatch('mango-sylius-sorting-products-after-persist', $event);
		} else {
			$message = $this->translator->trans('mango-sylius.ui.sortingPlugin.noProductMessage');
			$this->flashBag->add('error', $message);

			$redirectUrl = $this->router->generate('mango_sylius_admin_sorting_index');
		}

		return new RedirectResponse($redirectUrl);
	}
}
