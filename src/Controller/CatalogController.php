<?php

namespace App\Controller;

use App\Entity\Catalog;
use App\Form\CatalogFormType;
use App\Repository\CatalogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends BaseController
{

    /**
     * @var CatalogRepository
     */
    private $_catalogRepository;

    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    public function __construct(CatalogRepository $catalogRepository, EntityManagerInterface $entityManager)
    {
        $this->_catalogRepository = $catalogRepository;
        $this->_entityManager = $entityManager;
    }

    /**
     * Display list of products available in stock
     *
     * @Route("/admin/catalog", name="app_admin_catalog")
     * @IsGranted("ROLE_WRITER")
     */
    public function index()
    {
        $catalog = $this->_catalogRepository->findAll();
        return $this->render("admin/catalog/index.html.twig", ["catalog" => $catalog]);
    }

    /**
     * Add new item to the catalog of products
     *
     * @Route("/admin/catalog/new", name="app_admin_new_catalog")
     * @IsGranted("ROLE_WRITER")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(CatalogFormType::class);
        $form->handleRequest($request);

        //$catalog = new Catalog();

        if( $form->isSubmitted() && $form->isValid() )
        {
            $catalog = $form->getData();
            $this->_entityManager->persist($catalog);
            $this->_entityManager->flush();

            $this->addFlash("success", "Produit ajouté avec succès!");
            return $this->redirectToRoute("app_admin_catalog");
        }

        return $this->render("admin/catalog/catalogform.html.twig", ["catalogForm" => $form->createView()]);
    }

    /**
     * @Route("/admin/catalog/edit/{id}", name="app_admin_edit_catalog")
     * @IsGranted("ROLE_WRITER")
     */
    public function edit(Catalog $product, Request $request)
    {
        $form = $this->createForm(CatalogFormType::class, $product);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() )
        {
            $this->_entityManager->persist($product);
            $this->_entityManager->flush();
            return $this->redirectToRoute("app_admin_catalog");
        }

        return $this->render("admin/catalog/catalogform.html.twig", ["catalogForm" => $form->createView()]);
    }

    /**
     * @Route("/admin/catalog/disable/{id}", name="app_admin_disable_catalog", methods={"post"})
     * @IsGranted("ROLE_WRITER")
     */
    public function disable(Catalog $product)
    {
        $this->_catalogRepository->unpublish($product);
        return $this->json(["message" => "success", "value" => $product->getPublished()]);
    }

    /**
     * @Route("/admin/catalog/enable/{id}", name="app_admin_enable_catalog", methods={"post"})
     * @IsGranted("ROLE_WRITER")
     */
    public function enable(Catalog $product)
    {
        $this->_catalogRepository->publish($product);
        return $this->json(["message" => "success", "value" => $product->getPublished()]);
    }

    /**
     * @Route("/admin/catalog/delete", name="app_admin_delete_catalog")
     * @IsGranted("ROLE_WRITER")
     */
    public function delete()
    {

    }
}