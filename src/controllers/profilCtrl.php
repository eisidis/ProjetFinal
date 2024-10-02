<?php
session_start();
if (empty($_SESSION['id'])) header('Location: index.php');

// if(empty($_GET['id'])) {
//     header('Location: index.php');
// }

require 'models/User.php';
$user = new User();
$user->id = $_SESSION['id'];
$userInfo = $user->getUserById();


$error = [];
// var_dump($_POST['newMail']);

// modification
if (!empty($_POST)) {
    if ($_POST['confirmPassword'] !== $_POST['newPassword']) {
        $error['incorrectNewPassword'] = 'Les nouveau mots de passe ne correspondent pas';
        var_dump($error);
    }

    $value = str_replace(' ', '', $_POST['newPhone']);
    $value = str_replace('.', '', $_POST['newPhone']);
    $value = str_replace('-', '', $_POST['newPhone']);
    if (preg_match("/^0[1-9][0-9]{8}$/", $value)) {
        $user->phone = $_POST['newPhone'];
    }else {
        $error['value'] = "Le numéro de téléphone n'est pas valide !";
    }
    if (empty($error)) {
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


// var_dump($_POST);
// var_dump($error);






// if ($user->modify()) {
//     header('Location: index.php');
// }
// var_dump($user);




// en cliquant sur un bouton, rediriger vers une page delete account qui ajoute un
// parametre (par exemple 'deleted') pour éviter d'accéder à la page via l'url
// ou actualiser la page avec parametre url 'delete=true'