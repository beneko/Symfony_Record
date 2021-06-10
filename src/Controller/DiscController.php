<?php

namespace App\Controller;

use App\Entity\Disc;
use App\Form\DiscType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/disc")
 */
class DiscController extends AbstractController
{
    /**
     * @Route("/", name="disc_index", methods={"GET"})
     */
    public function index(): Response
    {
        $discs = $this->getDoctrine()
            ->getRepository(Disc::class)
            ->findAll();

        return $this->render('disc/index.html.twig', [
            'discs' => $discs,
        ]);
    }

    /**
     * @Route("/new", name="disc_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $disc = new Disc();
        $form = $this->createForm(DiscType::class, $disc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($disc);
            $entityManager->flush();

            return $this->redirectToRoute('disc_index');
        }

        return $this->render('disc/new.html.twig', [
            'disc' => $disc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{discId}", name="disc_show", methods={"GET"})
     */
    public function show(Disc $disc): Response
    {
        return $this->render('disc/show.html.twig', [
            'disc' => $disc,
        ]);
    }

    /**
     * @Route("/{discId}/edit", name="disc_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Disc $disc): Response
    {
        $form = $this->createForm(DiscType::class, $disc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disc_index');
        }

        return $this->render('disc/edit.html.twig', [
            'disc' => $disc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{discId}", name="disc_delete", methods={"POST"})
     */
    public function delete(Request $request, Disc $disc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$disc->getDiscId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($disc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('disc_index');
    }
}
