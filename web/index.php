<?php

ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);

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
        print 'register page';
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