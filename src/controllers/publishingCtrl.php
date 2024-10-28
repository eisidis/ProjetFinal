<?php
try {
    session_start();
} catch (\Throwable $th) {
    $error['globalError'] = 'Veuillez ne pas surchager';
}

if (empty($_SESSION['id'])) header('Location: index.php');

if (!empty($_POST)) {
    if (sizeof($_POST) > 1) {
        require_once 'models/Announcement.php';
        $announcement = new Announcement();
        $error = [];

        if (!empty($_FILES['file']['name'])) {
            if ($_FILES['file']['size'] !== 0) {
                if (!empty($_FILES['file']['name']) || !empty($_POST)) {
                    $allowed = ['image/png', 'image/jpg', 'image/jpeg'];
                    $filename = $_FILES['file'];
                    if (in_array($filename['type'], $allowed)) {
                        $announcement->image = 'test';
                    } else {
                        $error['file'] = "Seul les images en png, jpg et jpeg sont accepter";
                    }
                }
            } else {
                $error['file'] = "L'image doit être inférieur à 2 mo";
            }
        } else {
            $error['file'] = 'Image obligatoire';
        }

        if (!empty($_POST['title'])) {
            if (strlen($_POST['title']) >= 3 && strlen($_POST['title']) <= 75) {
                $announcement->title = htmlspecialchars($_POST['title']);
            } else {
                $error['title'] = "Entre 3 et 75 caracteres";
            }
        } else {
            $error['title'] = 'Titre obligatoire';
        }

        if (!empty($_POST['description'])) {
            if (strlen($_POST['description']) >= 3 && strlen($_POST['description']) <= 255) {
                $announcement->description = htmlspecialchars($_POST['description']);
            } else {
                $error['title'] = "Entre 3 et 75 caracteres";
            }
        } else {
            $error['description'] = 'Description obligatoire';
        }
        $announcement->id_pamq_categories = $_POST['category'];
        $announcement->id_pamq_users = $_SESSION['id'];


        if (empty($error)) {
            $announcement->registerAnnouncement();

        }
    }
} else if (!empty($_GET['form'])) {
    $error['file'] = "L'image doit être inférieur à 2 mo";
}

require_once 'models/Categories.php';

$categories = new Categories();
$categoriesData = $categories->getAll();


// var_dump($_FILES);
// var_dump($categoriesData);
// if (!file_exists('src/assets/')) {
//     mkdir('test');
//     var_dump('oui');
// }
// move_uploaded_file($_FILES["file"]["tmp_name"], 'assets/imgUser/' . $_FILES["file"]["name"]);
