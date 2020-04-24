<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService)
//    public function index(SessionInterface $session, ProductRepository $productRepository)
    {
//        // avant le cartService
//        $panier = $session->get('panier', []);
//
//        // tableau vide
//        $panierWithData = [];
//
//        //foreach pour recupérer les datas
//        foreach($panier as $id => $quantity) {
//            $panierWithData[] = [
//                'product' => $productRepository->find($id),
//                'quantity' => $quantity
//            ];
//        }

//        $total = 0;
//        /// le total de litem est = a item product ( prix) * la quantitée
//        foreach($panierWithData as $item)
//        {
//            if($item['product'] == !null)
//            {
//                $totalItem = $item['product']->getPrice() * $item['quantity'];
//                $total += $totalItem;
//            }
//        }

//        dd($panierWithData);

//
//        $panierWithData = $cartService->getFullCart();
//
//        $total = $cartService->getTotal();


        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            'totalQ' => $cartService->getTotalQuantity()
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
//    public function add($id, Request $request)
//    public function add($id, SessionInterface $session, ProductRepository $productRepository)
    public function add($id,CartService $cartService)
    {
        // J'utilise le CartService qui contient les methodes necessaires pour ajouter un produits
        $cartService->add($id);
        // Ci-dessous l'ancienne méthode avant la création du cartServie !!!!!!!!!!!!!!

        //je récupère la session dans la $request via Request $request
//        $session = $request->getSession();
//
//        //j'enregistre le panier  de la session en tant que tableau vide
//        $panier = $session->get('panier', []);
//
//        if(!empty($panier[$id]))
//        {
//            $panier[$id]++;
//
//        }else{
//            //je modifie la quantitée du panier  de la session
//            $panier[$id] = 1;
//
//        }
//
//        //je remplace le panier par mon $panier
//        $session->set('panier', $panier);
//
//        // Affiche le contenu du panier en dump&die !
////        dd($session->get('panier'));
//
////        return $this->render('cart/index.html.twig', []);
//
//        // redirection vers la liste des produits
////        return $this->render('product/index.html.twig', [
////            'products' => $productRepository->findAll()
////        ]);

        // ou
        // vers le panier :
        return $this->redirectToRoute("cart_index");

    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute("cart_index");

    }


    /**
     * @Route("/panier/remove/{id}", name="cart_remove_all")
     */
    public function removeAll($id, CartService $cartService)
    {
        $cartService->removeAll($id);

        return $this->redirectToRoute("cart_index");

    }












}
