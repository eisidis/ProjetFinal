<?php require_once './controllers/profilCtrl.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/profil.css">
    <title>Profil</title>
</head>

<body>
    <header>
        <div id="leftHeader">
            <div id="logo">
                <a href="./index.php"><img src="./assets/img/logo.png" alt=""></a>
            </div>
        </div>

        <div id="rightHeader">
            <div id="divConnect">
                <?php
                if (empty($_SESSION['id'])) {
                ?>
                    <a href="./connexion.php"><button class="blue">Se connecter</button></a>
                <?php
                } else {
                ?>
                    <a href="./profil.php"><img src="./assets/img/icon-profil.png" alt=""></a>
                    <a href="./logout.php"><button class="blue">Se déconnecter</button></a>
                <?php } ?>
            </div>
        </div>
    </header>
    <h1>Mon profil</h1>
    <div id="profilBtn">
        <button class="blue">Voir mes annonces</button>
        <a href="./publishing.php"><button class="blue">Publier</button></a>
        <button class="blue" id="openModal">Supprimer mon compte</button>
        <div class="modal" id="myModal">
            <div class="modalContent">
                <p>Etes vous sûr de vouloir supprimer votre compte ?</p>
                <div>
                    <a href="profil.php?id= <?= $userInfo->id ?>&delete=true"><button class="blue">Oui</button></a>
                    <button class="blue" id="noBtn">Non</button>
                </div>
            </div>
        </div>
    </div>

    <div id="userInfo">
        <p>Nom d'utilisateur: <?= $userInfo->username ?></p>
        <p>Email: <?= $userInfo->email ?></p>
        <p>Téléphone: <?= (empty($userInfo->phone) ? "telephone non renseigner" : $userInfo->phone) ?></p>
        <?php
        ?>
    </div>

    <div id="modifyPart">
        <form method="POST">
            <div class="accountEdit">
                <div class="infoTitlecontainer">
                    <h2 class="infoTitle">E-mail</h2>
                </div>
                <div class="editEntry">
                    <div class="entry">
                        <label for="">nouvel e-mail</label>
                        <input type="text" name="newEmail">
                    </div>
                </div>
            </div>
            <div class="accountEdit">
                <div class="infoTitlecontainer">
                    <h2 class="infoTitle">Mot de passe</h2>
                </div>
                <div class="editEntry">
                    <div class="entry">
                        <label for="">Nouveau mot de passe</label>
                        <input type="text" name="newPassword">
                    </div>

                    <div class="entry">
                        <label for="">confirmation du mot de passe</label>
                        <input type="text" name="confirmPassword">
                        <?php
                        if (!empty($error) && !empty($error['incorrectNewPassword'])) { ?>
                            <small><?= $error['incorrectNewPassword'] ?></small>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <div class="accountEdit">
                <div class="infoTitlecontainer">
                    <h2 class="infoTitle">Téléphone</h2>
                </div>
                <div class="editEntry">
                    <div class="entry">
                        <label for="">Nouveau numéro</label>
                        <input type="text" name="newPhone">
                    </div>
                </div>
            </div>

            <div class="accountEdit">
                <div class="infoTitlecontainer">
                    <h2 class="infoTitle">Confirmation</h2>
                </div>
                <div class="editEntry">
                    <div class="entry">
                        <label for="">Mot de passe actuel</label>
                        <input type="text" name="verifyPassword">
                        <?php
                        if (!empty($error) && !empty($error['incorrectActualPassword'])) { ?>
                            <small><?= $error['incorrectActualPassword'] ?></small>
                        <?php } ?>
                    </div>
                    <button class="blue" type="submit">Mettre à jour</button>

                </div>
            </div>
        </form>
    </div>

    <script src="./assets/js/modal.js"></script>
</body>

</html>