<?php
session_start();
if (empty($_SESSION['id'])) header('Location: index.php');

// if(empty($_GET['id'])) {
//     header('Location: index.php');
// }

require 'models/User.php';
$user = new User();
$user->id = $_SESSION['id'];
$userInfo = $user->getUserById(); //récupère toutes les informations de l'utilisateur connecter


$error = [];

// modification
if (!empty($_POST)) {
    if ($_POST['confirmPassword'] !== $_POST['newPassword']) {
        $error['incorrectNewPassword'] = 'Les nouveau mots de passe ne correspondent pas';
    }

    // Removes spaces, periods and hyphens
    $value = str_replace(' ', '', $_POST['newPhone']);
    $value = str_replace('.', '', $_POST['newPhone']);
    $value = str_replace('-', '', $_POST['newPhone']);
    // Checks if the number is valid with a regex
    if (preg_match("/^0[1-9][0-9]{8}$/", $value)) {
        $user->phone = $_POST['newPhone'];
    }else {
        $error['value'] = "Le numéro de téléphone n'est pas valide !";
    }
    if (empty($error)) {
        // Checks that the password entered is the same as in the database
        if (password_verify($_POST['verifyPassword'], $userInfo->password)) {
            $user->email = $_POST['newEmail'];
            $user->password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $user->modify();
            header('Location: profil.php');
        } else {
            $error['incorrectActualPassword'] = "Le mot de passe actuel n'est pas correcte";
        }
    }
}

if (!empty($_SESSION['id']) && !empty($_GET['delete']) && $_GET['delete'] == 'true') {
    if ($user->delete()) {
        header('Location: index.php');
        session_destroy();
        exit;
    }
}