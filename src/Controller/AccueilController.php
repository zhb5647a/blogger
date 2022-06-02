<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('accueil/index.html.twig',['articles' => $articles]); 

    }
    #[Route('/show/{id}', name: 'app_accueil_show')]
    public function getArticleById(ArticleRepository $articleRepository, $id): Response
    {
        $article = $articleRepository->find($id);
        // si l'article est égale a null
        if(!$article){
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('show/index.html.twig',['article' => $article]); 

    }
   
}
