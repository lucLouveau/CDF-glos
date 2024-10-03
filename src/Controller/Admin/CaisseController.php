<?php

namespace App\Controller\Admin;

use App\Repository\ProduitsRepository;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('{_locale<%app.supported_locales%>}/admin')]
class CaisseController extends AbstractController
{

    #[Route('/', name: 'app_caisse')]
    public function index(TypeRepository $types, ProduitsRepository $produits ,EntityManagerInterface $em): Response
    {   
        $listeTypes=$types->findBy([],['nom'=>'ASC']);
        $listeProduits=[];
        foreach ($listeTypes as $type) {
            $em->initializeObject($type->getProduits());
            $listeProduits[$type->getNom()]=$type->getProduits();
        }
        return $this->render('admin/caisse/commande.html.twig', [
            "produits"=>$listeProduits,
            "types"=>$listeTypes,
        ]);
    }
}
