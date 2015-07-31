<?php
    require 'config.php';
    require 'user.php';

    $user = new User($bd);

    switch ($_GET['code']) {
        case 'checkUser':
            $user->checkUser($_POST['user'], $_POST['pass']);

            break;

        case 'insert':
            $user->insert($_POST['user'], $_POST['pass']);

            break;

        case 'upload':
            if (is_dir('assets/' . $_POST['user']) == false) {
                mkdir('assets/' . $_POST['user']);
            }

            if (isset($_FILES['file'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], 'assets/' . $_POST['user'] . '/' . $_FILES['file']['name']);
            }

            break;
    }
?>