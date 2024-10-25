<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    // Define the entity manager property
    private EntityManagerInterface $entityManager;

    // Inject the entity manager via the constructor
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        // Set the default time zone to Central Africa Time (CAT)
        date_default_timezone_set('Africa/Johannesburg'); // or 'Africa/Gaborone'
    }

    /**
     * @Route("/blogpost/create", name="create_blogpost")
     */
    public function create(Request $request): Response
    {
        $blogPost = new BlogPost();

        // Handle form submission and set blog post properties
        // For example, you might get data from the request and set it on the blog post
        // $blogPost->setTitle($request->request->get('title'));
        // $blogPost->setContent($request->request->get('content'));

        // Persist the blog post entity
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush();

        return $this->redirectToRoute('blogpost_list');
    }

    // Other methods for the controller...
}