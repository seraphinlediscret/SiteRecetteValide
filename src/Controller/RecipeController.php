<?php

namespace App\Controller;

use App\Entity\Recettes;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function index()
    {
        $rec = $this->getDoctrine()->getRepository(Recettes::class);
        $recettes = $rec->findAll();   //ou findBy id =
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
            'recettes' => $recettes
        ]);
    }
}
