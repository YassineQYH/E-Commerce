<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/nous-contacter", name="contact")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('notice', 'Merci de nous avoir contacté. Notre équipe vous répondra dans les meilleurs délais.');

            //dd($form->getData());
            $content = "Bonjour </br>Mettre ici ce qu'on récup du formulaire.</br></br>";
            $mail = new Mail();
            $mail->send('q-destiny@live.be', 'La Boutique E-Commerce', 'Vous avez reçus une nouvelle demande de contact', $content);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
