<?php

// autoload
require_once(__DIR__.'/../vendor/autoload.php');

// get twig instance
$twig = new Twig_Environment(new Twig_Loader_Filesystem(__DIR__.'/../templates'));

$app = new App();
//$app->run();

// simple routing
switch ($_SERVER['REQUEST_URI']) {
    case '/':
        header('Location: /login');
        break;
    case '/login':
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $authenticated = $app->authentication->login($_POST['username'], $_POST['password']);
            if($authenticated) {
                header('Location: /profile');
            } else {
                print $twig->render('login.html.twig', ['errors' => ['Invalid credentials']]);
            }
        } else {
            print $twig->render('login.html.twig');
        }
        break;
    case '/register':
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $errors = [];
            if($error = \Validator\Validator::validate($_POST['username'], [\Validator\Constraints\NotEmpty::class])) {
                $errors['login'][] = $error;
            }
            if($error = \Validator\Validator::validate($_POST['email'], [\Validator\Constraints\NotEmpty::class, \Validator\Constraints\Email::class])) {
                $errors['email'][] = $error;
            }
            if($error = \Validator\Validator::validate(
                $_POST['password'],
                [
                    \Validator\Constraints\NotEmpty::class,
                    \Validator\Constraints\MinPassword::class
                ]
            )) {
                $errors['password'][] = $error;
            }
            if($error = \Validator\Validator::validate([$_POST['password'], $_POST['password_repeat']], [\Validator\Constraints\PasswordRepeat::class])) {
                $errors['password'][] = $error;
            }

            if(count($errors) === 0) {
                $app->authentication->register($_POST['username'], $_POST['email'], $_POST['password']);
                $authenticated = $app->authentication->login($_POST['username'], $_POST['password']);
                header('Location: /profile');
            } else {
                print $twig->render(
                    'register.html.twig',
                    [
                        'errors'          => $errors,
                        'username'        => $_POST['username'],
                        'email'           => $_POST['email'],
                        'password'        => $_POST['password'],
                        'password_repeat' => $_POST['password_repeat'],
                    ]);
            }
        } else {
            print $twig->render('register.html.twig');
        }
        break;
    case '/logout':
        $app->authentication->logout();
        header('Location: /login');
        break;
    case '/profile':
        if(!$app->authentication->isLoggedIn()) {
            print '403 Not Allowed';
        } else {
            print $twig->render('profile.html.twig', ['user' => $app->authentication->getCurrentUser()]);
        }
        break;
    default:
        print '404 Not Found.';
}