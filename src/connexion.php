<?php
require './controllers/connexionCtrl.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/connect.css">
    <title>FireBird</title>
</head>

<body>
    <div id="containerUser">
        <div id="log">
            <h2 class="title">Connexion</h2>
            <form action="" method="POST">
                <div class="containerForm">
                    <div class="groupForm">
                        <?php if (!empty($error) && !empty($error['login_username'])) { ?>
                            <small style="color: red;"><?= $error['login_username'] ?></small>
                        <?php } ?>
                        <label for="">Nom d'utilisateur</label>
                        <input type="text" name="login_username">
                    </div>
                    <div class="groupForm">
                        <?php if (!empty($error) && !empty($error['login_password'])) { ?>
                            <small style="color: red;"><?= $error['login_password'] ?></small>
                        <?php } ?>
                        <label for="">Mot de passe</label>
                        <input type="password" name="login_password">
                    </div>
                </div>
                <button name="type" value="login" type="submit">Se connecter</button>
            </form>
            <a href="">
                <p>Mot de passe oublié</p>
            </a>
        </div>
        <div id="verticalLine"></div>
        <div id="subscribe">
            <h2 class="title">Inscription</h2>
            <form method="POST">
                <div class="containerForm">
                    <div class="groupForm">
                        <?php if (!empty($error) && !empty($error['username'])) { ?>
                            <small><?= $error['username'] ?></small>
                        <?php } ?>
                        <label>Nom d'utilisateur</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="groupForm">
                        <?php if (!empty($error) && !empty($error['password'])) { ?>
                            <small style="color: red;"><?= $error['password'] ?></small>
                        <?php } ?>
                        <label for="">Mot de passe</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="groupForm">
                        <?php if (!empty($error) && !empty($error['confirmPassword'])) { ?>
                            <small style="color: red;"><?= $error['confirmPassword'] ?></small>
                        <?php } ?>
                        <label for="">Confirmé mot de passe</label>
                        <input type="password" name="confirmPassword" required>
                    </div>
                    <div class="groupForm">
                        <?php if (!empty($error) && !empty($error['email'])) { ?>
                            <small style="color: red;"><?= $error['email'] ?></small>
                        <?php } ?>
                        <label for="">Email</label>
                        <input type="text" name="email" required>
                    </div>
                </div>
                <button name="type" value="create" type="submit">S'inscrire</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>