<?php
require_once './controllers/publishingCtrl.php'
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css//publishing.css">
    <title>Publication</title>
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
                    <!-- <a href="./connexion.php"><button id="blue">S'inscrire</button></a> -->
                <?php
                }
                ?>
                <a href="./profil.php"><img src="./assets/img/icon-profil.png" alt=""></a>

                <a href="./logout.php"><button class="blue">Se déconnecter</button></a>


            </div>
        </div>
    </header>
    <h1>Publication</h1>
    <div>
        <form method="POST" action="publishing.php?form=true" enctype="multipart/form-data">
            <div class="containerForm">
                <div class="groupForm">
                    <label for="">Sélectionnez une image</label>
                    <input id="test" type="file" name="file" max_size='20' accept=".png, .jpg, jpeg">
                    <?php if (!empty($error) && !empty($error['file'])) { ?>
                        <small><?= $error['file'] ?></small>
                    <?php } ?>
                </div>

                <div class="groupForm">
                    <label for="">Sélectionnez un titre</label>
                    <input type="text" name="title">
                    <?php if (!empty($error) && !empty($error['title'])) { ?>
                        <small><?= $error['title'] ?></small>
                    <?php } ?>
                </div>

                <div class="groupForm">
                    <label for="">Sélectionnez une catégorie</label>
                    <select name="category">
                        <?php foreach ($categoriesData as $cat) { ?>
                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="groupForm">
                    <label for="">Sélectionnez une description</label>
                    <textarea class="" name="description" id="" cols="40" rows="7"></textarea>
                    <?php if (!empty($error) && !empty($error['description'])) { ?>
                        <small><?= $error['description'] ?></small>
                    <?php } ?>
                    <!-- <small>
                         // $error['globalError'] ?>
                    </small> -->
                </div>
            </div>
            <button class="blue" type="submit">Publier</button>
        </form>
    </div>
</body>

</html>