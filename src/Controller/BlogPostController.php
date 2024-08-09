<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogPostController extends AbstractController
{
    #[Route('/blog/post', name: 'app_blog')]
    public function createBlogPost(EntityManagerInterface $entityManager): Response
    {   
        // Creating a variable ($blogpost), that will hold values for the new instance or method () of the class
        $blog_post = new BlogPost();
        /*
         * $blog_post->setId(1)
         * Doctrine will handle the ID assignment automatically if configured correctly
         */

        /*
         * Creating an instance ($entityManager)that is marked to the entity ($blogpost)
         * Mark the entity as managed and ready to be persisted
         *  */ 
        $entityManager->persist($blog_post);

        /** executing the queries (i.e. the INSERT query)
         * flush all changes to the database
        */
        $entityManager->flush();

        return new Response('Saved new blogpost with id '.$blog_post->getId());
    }
}