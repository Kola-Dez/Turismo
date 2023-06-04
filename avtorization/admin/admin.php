<?php
session_start();

if ($_SESSION['name'] !== 'admin') {
    header('Location: ../../404.html');
    exit;
} else {
    require_once '../../config/ClassAdmin.php';
    $db = new ClassAdmin();
    $allUsers = $db->All('users');
    $allplaces = $db->All('places');
    
    if (!empty($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $db->Delite($_GET['t'], $deleteId);
        $hu = $_GET['t'];
        header("Location: admin.php?$hu");
        exit;
    }
    if(!empty($_POST['Update'])){
        $db->UpdatePlaces('places', $_POST['id'], $_POST['name'], $_POST['price'], $_POST['region'], $_POST['img']);
        header('Location: admin.php?places');
        exit;
    }
    if(!empty($_POST['Creat'])){
        // проверка на фаил
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $targetDirectory = '../../img/'; // Директория, куда будут сохраняться загруженные файлы
        
            // Проверка наличия ошибок при загрузке файла
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileName = $_FILES['file']['name']; // Имя файла
                $fileTmpPath = $_FILES['file']['tmp_name']; // Временный путь файла
        
                // Проверка расширения файла
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    echo 'Ошибка: Разрешены только файлы с расширениями JPG, JPEG, PNG, GIF и WEBP.';
                    exit;
                }
        
                // Генерация уникального имени файла для предотвращения перезаписи файлов с одинаковыми именами
                $newFileName = uniqid() . '.' . $fileExtension;
        
                // Полный путь для сохранения файла
                $targetFilePath = $targetDirectory . $newFileName;
        
                // Перемещение загруженного файла в указанную директорию
                if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                    echo 'Файл успешно загружен: ' . $targetFilePath;
        
                    $db->CreatPlaces('places', $_POST['name'], $_POST['price'], $_POST['region'], $newFileName);
                    header('Location: admin.php?places');
                    exit;
                } else {
                    echo 'Ошибка при загрузке файла1.';
                    exit;
                }
            } else {
                echo 'Ошибка при загрузке файла2.';
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Административная панель</title>
    <link rel="icon" href="../../img/icon.ico" type="images/x-icon">
    <link rel="stylesheet" href="adminStyle.css">
</head>
<body>
<div class="head"><?php require_once '../../attributes/head/head.php'; ?></div>
<div class="admin-panel">
    <div class="sidebar">
        <ul class="ul--1">
            <li class="li--1"><a class="a--1" href="?users">Пользователи</a></li>
            <li class="li--1"><a class="a--1" href="?places">Статьи</a></li>
            <li class="li--1"><a class="a--1" href="#">Настройки</a></li>
        </ul>
    </div>
    <div class="content">
        <?php if(isset($_GET['users'])){?>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
            <?php foreach ($allUsers as $key) { ?>
                <tr>
                    <td><?= $key['id'] ?></td>
                    <td><?= $key['name'] ?></td>
                    <td><?= $key['email'] ?></td>
                    <td>
                        <a class="button" href="?delete_id=<?= $key['id']; ?>&t=users" onclick="return confirm('Вы уверены, что хотите удалить пользователя?')">Удалить</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php } else if(isset($_GET['places'])){?>
            <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>price</th>
                <th>region</th>
                <th>img</th>
                <th>Действия</th>
            </tr>
            <?php foreach ($allplaces as $key) { ?>
                <tr>
                    <td><?= $key['id'] ?></td>
                    <td><?= $key['name'] ?></td>
                    <td><?= $key['price'] ?></td>
                    <td><?= $key['region'] ?></td>
                    <td><?= $key['img'] ?></td>
                    <td>
                        <a class="button" href="?delete_id=<?= $key['id']; ?>&t=places" onclick="return confirm('Вы уверены, что хотите удалить Статью ?')">Удалить</a>
                        <a class="button" href="?update=<?= $key['id']; ?>">Изменить</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a class="button" href="?cread">Добавить</a>
        <?php }else if (isset($_GET['update'])) { ?>
            <form method="post" action="" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>price</th>
                        <th>region</th>
                        <th>img</th>
                    </tr>
                    <?php foreach ($allplaces as $key) {
                        if ($key['id'] == $_GET['update']) { ?>
                            <tr>
                                <td><?= $key['id']; ?></td>
                                <td><input type="text" name="name" value="<?= $key['name']; ?>"></td>
                                <td><input type="text" name="price" value="<?= $key['price']; ?>"></td>
                                <td><input type="text" name="region" value="<?= $key['region']; ?>"></td>
                                <td><input type="text" name="img" value="<?= $key['img']; ?>"></td>
                                <td>
                                    <input type="hidden" name="id" value="<?= $key['id']; ?>">
                                    <input type="submit" name="Update" value="Обновить">
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </form>
        <?php } else if (isset($_GET['cread'])) { ?>
            <form method="post" action="" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>Имя</th>
                        <th>price</th>
                        <th>region</th>
                        <th>img</th>
                    </tr>
                        <tr>
                            <td><input type="text" required="required" name="name" placeholder="Name"></td>
                            <td><input type="text" required="required" name="price" placeholder="Price"></td>
                            <td>
                                <input type="radio" id="huey" name="region" value="Иссык-Кульская" checked>
                                <label for="Иссык-Кульская">Иссык-Кульская</label>
                                </div>

                                <div>
                                    <input type="radio" id="dewey" name="region" value="Чуйская">
                                    <label for="Чуйская">Чуйская</label>
                                </div>

                                <div>
                                    <input type="radio" id="louie" name="region" value="Таласская">
                                    <label for="Таласская">Таласская</label>
                                </div>

                                <div>
                                    <input type="radio" id="louie" name="region" value="Нарынская">
                                    <label for="Нарынская">Нарынская</label>
                                </div>

                                <div>
                                    <input type="radio" id="louie" name="region" value="Ошская">
                                    <label for="Ошская">Ошская</label>
                                </div>

                                <div>
                                    <input type="radio" id="louie" name="region" value="Джалал-Абадская">
                                    <label for="Джалал-Абадская">Джалал-Абадская</label>
                                </div>

                                <div>
                                    <input type="radio" id="louie" name="region" value="Джалал-Абадская">
                                    <label for="Джалал-Абадская">Баткенская</label>
                                </div>
                                
                            </td>
                            <td>
                                <input type="file" name="file">

                            </td>

                            <td><input type="submit" name="Creat" value="Добавить"></td>
                        </tr>
                </table>
            </form>
        <?php } ?>
    </div>
</div>
</body>
</html>
