<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ActionBookController extends AbstractController {
    /**
     * @Route("/edit/{id}")
     */
    public function editBook($id, Request $request) {

        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($book);
        $entityManager->flush();
        if (!$book) {
            throw $this->createNotFoundException(
                'Не существует книги с номером '.$id
            );
        }

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['label' => 'Название'])
            ->add('author', TextType::class, ['label' => 'Автор'])
            ->add('year', NumberType::class, ['label' => 'Год издания'])
            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $editedBook = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($editedBook);
            $entityManager->flush();
            return $this->redirectToRoute('main_page');
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/create")
     */
    public function createBook(Request $request) {

        $book = new Book();

        $form = $this->createFormBuilder($book)
            ->add('title', TextType::class, ['label' => 'Название'])
            ->add('author', TextType::class, ['label' => 'Автор'])
            ->add('year', NumberType::class, ['label' => 'Год издания'])
            ->add('save', SubmitType::class, ['label' => 'Добавить книгу'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newBook = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newBook);
            $entityManager->flush();
            return $this->redirectToRoute('main_page');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="main_page")
     */
    public function showMainPage() {

        $booksList = $this->getDoctrine()->getRepository(Book::class)->findAll();

        return $this->render('main.html.twig', [
            'books' => $booksList
        ]);
    }
}