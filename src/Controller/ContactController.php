<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * Función para ir al index
     * @Route("/", name="contact_index", methods={"GET"})
     */
    public function index(): Response
    {
        /*    public function index(ContactRepository $contactRepository): Response
        {
         return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
        }
        */
        return $this->render('contact/index.html.twig');
    }

    /**
     * Función para crear un contacto, crea un contacto vacío, un formualario y una vez los campos están completados
     * crea el contacto y redirecciona al index
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Función que rendecira "show.html" y le pasa un contacto en concreto cuya id recibe como parámetro
     * @Route("/{id}", name="contact_show", methods={"GET"})
     */
    public function show(Contact $contact): Response
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * Función que crea un formulario para visualizar los datos permitiendo cambiar los campos, una vez sean aptos 
     * realiza el cambio y rederiza el index
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_index');
    }

    /**
     * Función que carga toda la lista de contactos y la manda a una plantilla donde se muestran los campos de cada
     * contacto, además, tiene un campo "type" añadido para hacer un condicional y mostrar un tipo de contato u otro
     * en función de la petición, ese "type" de contacto viene dado por parámetro
     * @Route("/list/{type}", name="list")
     */
    public function list(Request $request, $type):Response{
        $contact = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->findAll();

        return $this->render('contact/showContact.html.twig',[
            'list'=>$contact,
            'typeContact'=>$type,
        ]);
    }
}
