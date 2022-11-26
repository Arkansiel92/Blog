<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\form;

class ArticlesController extends AbstractController
{
    // entity est dans la class AbstractController
    public function index() {
        $this->load('Article');
        $articles = $this->entity->getAll();

        $this->render('index', ['articles' => $articles]);
    }

    public function write() {

        if (form::validate($_POST, ['title', 'content'])) {
            $title = strip_tags($_POST['title']);
            $content = strip_tags($_POST['content']);

            $article = new Article;

            $article->setTitle($title)
                ->setContent($content);

            $article->create();
        }

        $form = new form;

        $form->startForm('post')
            ->addLabelFor('title', 'Titre : ')
            ->addInput('title', 'title', [
                'class' => 'form-control',
                'placeholder' => 'Titre',
                'id' => 'title'
            ])
            ->addLabelFor('content', 'Contenu :')
            ->addTextArea('content', "", [
                'class' => 'form-control',
                'rows' => 12,
                'id' => 'content'
            ])
            ->addButton('Envoyer', [
                'class' => 'my-3 btn btn-primary'
            ])
            ->endForm();

        $this->render('write', ['form' => $form->create()]);
    }
}