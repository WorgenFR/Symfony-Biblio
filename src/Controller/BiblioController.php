<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Rayon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livre;

class BiblioController extends AbstractController
{

    /**
     * @Route("/biblio", name="biblio",options={"expose"=true})
     */
    public function index(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $livres = $entityManager->getRepository(Livre::class)->findAll();
        $auteurs = $entityManager->getRepository(Auteur::class)->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        $rayons = $entityManager->getRepository(Rayon::class)->findAll();
       //$form = $this->createForm(LivreType::class, )

        return $this->render("biblio/index.html.twig", [
            'livres' => $livres,
            'categories' => $categories,
            'rayons' => $rayons,
            'auteurs' => $auteurs,
        ]);
    }

    /**
     * @Route("/biblio/modify",options={"expose"=true})
     */
    public function modifyLivre(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $titre = $request->request->get('titre');
        $date = new \DateTime($request->request->get('date'));
        $auteurp = $request->request->get('auteurp');
        $auteurn = $request->request->get('auteurn');
        $id_livre = $request->request->get('id_livre');
        $id_auteur = $request->request->get('id_auteur');
        $livremodif = $entityManager->getRepository(Livre::class)->findOneBy(['id' => $id_livre]);
        $auteurmodif = $entityManager->getRepository(Auteur::class)->findOneBy(['id' => $id_auteur]);
        $livremodif->setTitre($titre);
        $livremodif->setDateParution($date);
        $auteurmodif->setPrenom($auteurp);
        $auteurmodif->setNom($auteurn);
        $entityManager->persist($livremodif);
        $entityManager->persist($auteurmodif);
        $entityManager->flush();
        return new JsonResponse('Le livre a ete modifie');
    }

    /**
     * @Route("/biblio/{rayon}/{categorie}", defaults={"categorie" = null},options={"expose"=true})
     */
    public function rayon_categorie($rayon, $categorie): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $livres = $entityManager->getRepository(Livre::class)->findAll();
        $rayons = $entityManager->getRepository(Rayon::class)->findAll();

        if($categorie == null){
            $categories = $entityManager->getRepository(Categorie::class)->findAll();
        }
        else{
            $categories = $entityManager->getRepository(Categorie::class)->findBy(array('libCatg' => $categorie));
        }

        return $this->render("biblio/rayon_categorie.html.twig", [
            'rayon' => $rayon,
            'categorie' => $categorie,
            'livres' => $livres,
            'categories' => $categories,
            'rayons' => $rayons,
        ]);
    }
}
