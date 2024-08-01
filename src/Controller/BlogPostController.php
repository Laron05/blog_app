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
        $blog_post = new BlogPost();
        /**
         * $blog_post->setId(1)
         * Doctrine will handle the ID assignment automatically if configured correctly
         */
       // $blog_post->setTitle('Blog2');
        // $blog_post->setContent('I am a backend engineer intern. I use PHP - Symfony for my daily scripting tasks.
        // I intend to keep learning on-the-job, especially APIs, CI/CD, version control,
        // and cloud technologies just to list a few');
        // $blog_post->setCreatedOn(new \DateTime());
        // $blog_post->setUpdatedOn(new \DateTime());

        // telling Doctrine I want to eventually save the BlogPost (no queries yet)
        $entityManager->persist($blog_post);

        // executing the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new blogpost with id '.$blog_post->getId());
    }
}