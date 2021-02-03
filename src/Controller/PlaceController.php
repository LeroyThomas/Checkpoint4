<?php

namespace App\Controller;

use App\Entity\Place;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
