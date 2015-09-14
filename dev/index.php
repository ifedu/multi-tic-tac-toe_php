<?php
    session_start();

    require 'config.php';
    require 'class/challenge.php';
    require 'class/user.php';

    $challenge = new Challenge($bd);
    $user = new User($bd);

    switch ($_GET['code']) {
        case 'challenge-checkUser':
            $challenge->checkUser($_POST['user']);

            break;

        case 'checkUser':
            $user->checkUser($_GET['user'], $_GET['pass']);

            break;

        case 'insert':
            $user->insert($_GET['user'], $_GET['pass']);

            break;

        case 'upload':
            $user->upload($_POST['user']);

            break;
    }
?>