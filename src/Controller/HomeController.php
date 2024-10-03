<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('{_locale<%app.supported_locales%>}')]
class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(TypeRepository $types): Response
    {   
        $listeTypes=$types->findBy([],['nom'=>'ASC']);
        return $this->render('user/home/index.html.twig', [
            "types" => $listeTypes,
        ]);
    }

    #[Route('/{type}', name: 'app_type')]
    public function typePage(TypeRepository $types, int $type, EntityManagerInterface $em): Response
    {   
        $type=$types->find(['id'=>$type]);
        $em->initializeObject($type->getProduits());
        $produits=$type->getProduits();
        return $this->render('user/type/type-page.html.twig', [
            "produits"=>$produits,
            "type"=>$type->getNom()
        ]);
    }
}
