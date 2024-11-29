<?php

namespace App\Controller;

use App\Entity\Club; 
use App\Form\FormulaireClubType; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ClubRepository;
use Symfony\Component\Form\FormTypeInterface;

class ClubController extends AbstractController
{
    #[Route('/clubs', name: 'club_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupération de tous les clubs
        $clubs = $entityManager->getRepository(Club::class)->findAll();

        return $this->render('club/index.html.twig', [
            'clubs' => $clubs,
        ]);
    }

    #[Route('/clubs/add', name: 'club_add')]
    public function addClub(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'un nouvel objet Club
        $club = new Club();

        // Création du formulaire
        $form = $this->createForm(FormulaireClubType::class, $club);

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et validé
        if ($form->isSubmitted()) {
            // Persister l'objet Club dans la base de données
            $entityManager->persist($club);
            $entityManager->flush();

            // Redirection vers la page de la liste des clubs
            return $this->redirectToRoute('club_add');
        }
            $clubs = $entityManager->getRepository(Club::class)->findAll();
        
            // Pass the form and the list of clubs to the template
            return $this->render('club/add.html.twig', [
                'form' => $form->createView(),
                'clubs' => $clubs, // Pass the list of clubs to the template
            ]);

    }


    #[Route('/clubs/supprimer/{id}', name: 'club_delete')]
    public function deletC($id,ManagerRegistry $doc,ClubRepository $rep): Response
    {   //find club
        $club=$rep->find($id);
        //delete club
        $em=$doc->getManager();
        $em->remove($club);
        $em->flush();//commit au niv  de base de données

        return $this->redirectToRoute('club_add');
    }
    #[Route('/clubs/edit/{id}', name: 'club_modify')]
    public function editClub($id,Request $request, EntityManagerInterface $entityManager,ClubRepository $rep): Response
    {
        //find club
        $club=$rep->find($id);

        
        $form = $this->createForm(FormulaireClubType::class, $club);

        
        $form->handleRequest($request);

        
        if ($form->isSubmitted()) {
            
            $entityManager->flush();

            
            return $this->redirectToRoute('club_add');
        }

        // Affichage du formulaire d'ajout
        return $this->render('club/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
