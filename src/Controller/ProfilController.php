<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\User;
use App\Form\ProfilType;
use App\Repository\ProfilRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/", name="profil_index", methods={"GET"})
     */
    public function index(ProfilRepository $profilRepository): Response
    {
        return $this->render('profil/index.html.twig', [
            'profils' => $profilRepository->findAll(),
        ]);
    }

//    /**
//     * @Route("/{id}/edit", name="profil_edit", requirements={"id":"\d+"}, methods={"GET","POST"})
//     * @param Request $request
//     * @param Profil $profil
//     * @return Response
//     */
//    public function edit(Request $request , Profil $profil): Response
//    {
//        $user = $this->getUser();
//        $form = $this->createForm(ProfilType::class, $profil);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('home');
//        }
//
//        return $this->render('profil/edit.html.twig', [
//            'profil' => $profil,
//            'user' => $user,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/new", name="profil_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $profil = new Profil();
        $profil->setUser($this->getUser());

        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profil);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('profil/new.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profil_show", methods={"GET"})
     */
    public function show(Profil $profil): Response
    {
        return $this->render('profil/show.html.twig', [
            'profil' => $profil,
        ]);
    }



    /**
     * @Route("/{id}", name="profil_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Profil $profil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($profil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profil_index');
    }
}
