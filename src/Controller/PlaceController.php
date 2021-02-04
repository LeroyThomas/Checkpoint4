<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Place;
use App\Form\CommentType;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends AbstractController
{
    /**
     * @Route("/lieux", name="place_index", methods={"GET"})
     * @param PlaceRepository $placeRepository
     * @return Response
     */
    public function index(PlaceRepository $placeRepository): Response
    {
        $places = $placeRepository->findAll();

        return $this->render('place/listPlace.html.twig', [
            'places' => $places,
        ]);
    }

    /**
     * @Route("/lieux/{id}", name="place_show", methods={"GET", "POST"})
     * @param Place $place
     */
    public function showPlace(Place $place, Request $request)
    {
        $comment = new Comment();
        // Create the associated Form
        $form = $this->createForm(CommentType::class, $comment);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setPlace($place);
//            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            $user = $this->getUser();
            $comment->setUser($user);

            $entityManager->persist($comment);
            $entityManager->flush();
        }

            return $this->render('place/placeDetail.html.twig', [
                'place'=>$place,
                'form'=> $form->createView(),
        ]);
    }
}
