<?php

namespace App\Controller;

use App\Classe\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $mail = new Mail();
        $mail->send('q-destiny@live.be', 'Yass Kay', 'Mon premier mail', "Bonjour Yass, j'espère que tu vas bien.");


        return $this->render('home/index.html.twig');
    }
}
