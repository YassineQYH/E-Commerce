<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart, Request $request)
    {
        if (!$this->getUser()->getAddresses()->getValues())
        {
            return $this->redirectToRoute('account_address_add');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser() /* Me permettra de récupérer dans mon formulaire l'utilisateur en question pour récupérer ses adresses à lui et pas aussi celles des autres utilisateurs. | Voir ensuite OrderType.php */
        ]);

            $form->handleRequest($request); /* Pour dire au formulaire : écoute la requête s'il te plait. */

            if ($form->isSubmitted() && $form->isValid()) {
                //dd($form->getData());
            }

        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }
}
