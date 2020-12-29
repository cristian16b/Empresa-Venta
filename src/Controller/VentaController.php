<?php

namespace App\Controller;

use App\Entity\Venta;
use App\Form\VentaType;
use App\Repository\VentaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/venta')]
class VentaController extends AbstractController
{
    #[Route('/', name: 'venta_index', methods: ['GET'])]
    public function index(VentaRepository $ventaRepository): Response
    {
        return $this->render('venta/index.html.twig', [
            'ventas' => $ventaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'venta_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $ventum = new Venta();
        $form = $this->createForm(VentaType::class, $ventum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ventum);
            $entityManager->flush();

            return $this->redirectToRoute('venta_index');
        }

        return $this->render('venta/new.html.twig', [
            'ventum' => $ventum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'venta_show', methods: ['GET'])]
    public function show(Venta $ventum): Response
    {
        return $this->render('venta/show.html.twig', [
            'ventum' => $ventum,
        ]);
    }

    #[Route('/{id}/edit', name: 'venta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Venta $ventum): Response
    {
        $form = $this->createForm(VentaType::class, $ventum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('venta_index');
        }

        return $this->render('venta/edit.html.twig', [
            'ventum' => $ventum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'venta_delete', methods: ['DELETE'])]
    public function delete(Request $request, Venta $ventum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ventum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ventum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('venta_index');
    }
}
