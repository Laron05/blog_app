<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Defining a class BlogController, with properties make, model, and year
 * adding properties index() and text()
 */
class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    #[Route('/blog', name: 'app_blog')]
    public function text(): Response
    {
        return new Response(content: '<h1>BLOG APPLICATION</h1>');
    }
}