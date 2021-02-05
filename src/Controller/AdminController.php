<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Profil;
use App\Form\PlaceType;
use App\Form\ProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param Request $request
     * @return Response
     */
    public function addPlace(Request $request): Response
    {
        $place = new Place();

        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($place);
            $entityManager->flush();

            return $this->redirectToRoute('place_index');
        }
        return $this->render('admin/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
