<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\form;

Class UsersController extends AbstractController
{
    public function index() {
        $this->load('Users');
        $users = $this->entity->getAll();

        $this->render('index', ['users' => $users]);
    }

    public function register() {

        if(form::validate($_POST, ['email', 'password'])) {
            
            $email = strip_tags($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $user = new Users;

            $user->setEmail($email)
                ->setPassword($password)
                ->setRole('Utilisateur');

            $user->create();
        };

        $form = new form();

        $form->startForm('post')
            ->addLabelFor('email', 'Email :')
            ->addInput('email', 'email', [
                'class' => 'form-control',
                'placeholder' => 'exemple@exemple.fr',
                'id' => 'email'
            ])
            ->addLabelFor('password', 'Mot de passe :')
            ->addInput('password', 'password', [
                'class' => 'form-control',
                'placeholder' => 'mot de passe',
                'id' => 'password'
            ])
            ->addButton('Créer', [
                'class' => 'my-3 btn btn-primary'
            ])
            ->endForm();


        $this->render('register', [
            'form' => $form->create()
        ]);
    }

    public function login() {

        if (form::validate($_POST, ['email', 'password'])) {
            $userEntity = new Users;

            $userArray = $userEntity->findOneByEmail(strip_tags($_POST['email']));

            if (!$userArray) {
                $_SESSION['message_err'] = 'adresse mail ou mot de passe incorrect';
                header('Location : /users/login');
                exit();
            }

            $user = $userEntity->hydrate($userArray);
            
            if(password_verify($_POST['password'], $user->getPassword())) {
                $user->setSession();
            } else {
                $_SESSION['message_err'] = 'adresse mail ou mot de passe incorrect';
                header('Location : /users/login');
                exit();
            }
        }

        $form = new form();

        $form->startForm('post')
            ->addLabelFor('email', 'Email :')
            ->addInput('email', 'email', [
                'class' => 'form-control',
                'placeholder' => 'exemple@exemple.fr',
                'id' => 'email'
            ])
            ->addLabelFor('password', 'Mot de passe :')
            ->addInput('password', 'password', [
                'class' => 'form-control',
                'placeholder' => 'mot de passe',
                'id' => 'password'
            ])
            ->addButton('Créer', [
                'class' => 'my-3 btn btn-primary'
            ])
            ->endForm();

        //$_SESSION['user'] = [];
        $this->render('login', ["form" => $form->create()]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /articles');
        exit();
    }
}