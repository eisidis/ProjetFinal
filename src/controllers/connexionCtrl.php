<?php
// Démarre une session
session_start();


if (!empty($_POST) && !empty($_POST['type'])) {
    require_once 'models/User.php';
    $user = new User();
    $error = [];

    // Inscription
    if ($_POST['type'] == 'create') {
        // Attente de l'utilisateur
        if (!empty($_POST)) {
            // Condition concernant le nom d'utilisateur
            if (!empty($_POST['username'])) {
                if (strlen($_POST['username']) >= 3 && strlen($_POST['username']) <= 50) {
                    $user->username = htmlspecialchars($_POST['username']);
                    $checkUser = $user->getUserByUsername();
                    if ($checkUser) {
                        $error['username'] = "nom d'utilisateur déjà utiliser";
                    }
                } else {
                    $error['username'] = 'Entre 3 et 50 caracteres';
                }
            } else {
                $error['username'] = "Nom d'utilisateur obligatoire";
            }

            // Condition concernant le mot de passe
            if (!empty($_POST['password'])) {
                if (!empty($_POST['confirmPassword'])) {
                    if ($_POST['password'] == $_POST['confirmPassword']) {
                        // Permet de hasher le mot de passe
                        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    } else {
                        $error['confirmPassword'] = 'Les mots de passes ne correspondent pas';
                    }
                } else {
                    $error['confirmPassword'] = 'Confirmation de mot de passe obligatoire';
                }
            } else {
                $error['password'] = 'Mot de passe obligatoire';
            }

            // Condition concernant l'email
            if (!empty($_POST['email'])) {
                // Vérifie si l'email est valide
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $user->email = htmlspecialchars($_POST['email']);
                    $checkUser = $user->getUserByEmail();
                    // Vérifie si l'email est déjà utiliser
                    if ($checkUser) {
                        $error['email'] = 'email déjà utiliser';
                    }
                } else {
                    $error['email'] = 'email non valide';
                }
            } else {
                $error['email'] = 'email obligatoire';
            }

            // Enregistre et connecte l'utilisateur s'il n'y a pas d'erreur
            if (empty($error)) {
                $user->register();
                $userInfo = $user->getUserByUsername();
                if ($userInfo) {
                    $_SESSION['id'] = $userInfo->id;
                    // var_dump($userInfo);
                }
                if ($_SESSION['id']) {
                    header('Location: index.php');
                }
            }
        }
    } else {
        // connexion
        if (!empty($_POST['login_username'])) {
            $username = $_POST['login_username'];
        } else {
            $error['login_username'] = "Nom d'utilisateur obligatoire";
        }

        if (!empty($_POST['login_password'])) {
            $password = $_POST['login_password'];
        } else {
            $error['login_password'] = 'Mot de passe obligatoire';
        }

        if (empty($error)) {
            $user->username = $_POST['login_username'];
            // Récupère les informations de l'utilisateur grâce au nom d'utilisateur
            $userInfo = $user->getUserByUsername();
            if ($userInfo) {
                if (password_verify($password, $userInfo->password)) {
                    $_SESSION['id'] = $userInfo->id;
                    header('Location: index.php');
                } else {
                    $error['login_password'] = 'Mot de passe incorrecte';
                }
            } else {
                $error['global'] = 'Inscription reussie mais connexion echouer';
            }
        }
    }
}
