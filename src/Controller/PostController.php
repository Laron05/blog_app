<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Defining a route, /post
 * Defining a class PostController and extending as AbstractController
 */
#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET'])]

    // Setting a method (index(""...)) 
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        // Render a view and pass posts to it
        return $this->render('post/index.html.twig', [
            // Fetch all blog posts from the repository
            'blog_posts' => $blogPostRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        // Creating an instance of a class
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        // Checking whether a form is submitted by the user
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($blogPost);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }
        
        // Rendering a Twig template and return the result as a Response object.
        return $this->render('post/new.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_show', methods: ['GET'])]
    public function show(BlogPost $blogPost): Response
    {
        // Rendering a Twig template and return the result as a Response object.
        return $this->render('post/show.html.twig', [
            'blog_post' => $blogPost,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlogPost $blogPost, EntityManagerInterface $entityManager): Response
    {
        // Create the form for editing the blog post
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);
        
        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the updated_on value from the request
            $updatedOn = $request->request->get('updated_on');
            
            // Set the updated_on field to the current date and time
            $blogPost->setUpdatedOn(new \DateTime($updatedOn));
    
            // Persist the changes to the database
            $entityManager->flush();
    
            // Redirect to the index route after successful update
            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }
        
        // Render the edit form view
        return $this->render('post/edit.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, BlogPost $blogPost, EntityManagerInterface $entityManager): Response
    {

        // using an if statement to set a condition for a given route
        if ($this->isCsrfTokenValid('delete'.$blogPost->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($blogPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
