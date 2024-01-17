<?php
session_start();
require_once "../../config/avtorization.php";
if(empty($_SESSION['img'])){
    $_SESSION['img'] = 'Defolt.png';
}


if (isset($_POST['Update'])) {
    $db = new avtorization();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $targetDirectory = '../../imgDefolt/imgUsers/'; // Directory where uploaded files will be saved

        // Check for errors during file upload
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['file']['name']; // Original file name
            $fileTmpPath = $_FILES['file']['tmp_name']; // Temporary file path

            // Check file extension
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo 'Ошибка: Разрешены только файлы с расширениями JPG, JPEG, PNG, GIF и WEBP.';
                exit;
            }

            // Generate a unique file name to prevent overwriting
            $newFileName = uniqid() . "_" . $fileName;
            // Full path for saving the file
            $targetFilePath = $targetDirectory . $newFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                echo 'Файл успешно загружен: ' . $targetFilePath;

                // Update user information in the database
                $db->UpdateUser('users', $_SESSION['user_id'], $_POST['name'], $newFileName);
                $newUser = $db->selectFunNAME('users', $_POST['name']);
                session_unset();
                $_SESSION['user_id'] = $newUser['id'];
                $_SESSION['name'] = $newUser['name'];
                $_SESSION['img'] = $newUser['img'];
                header('Location: /');
                exit;
            } else {
                echo 'Ошибка при загрузке файла.';
                exit;
            }
        } else {
            echo 'Ошибка при загрузке файла2.';
            print_r($_FILES);
            exit;
        }
    }
}
?>

<style>
.all{
    height:500px;
    margin: 0 20% 0 20%;
}
.Alluser{
    width: auto;
    padding-top: 5%;
    background:#f1f1f1; 
    float: right;
    margin: 0 15px 15px 0; 
    text-align:center;
    padding: 10px;
    border-radius: 20px;
}
.AlluserIMG{
    width: auto;
    padding-top: 5%;
    background:#f1f1f1;
    border-radius: 10px;
    float: left;
    margin: 0 15px 15px 0; 
    text-align:center;
    padding: 10px;
}
/* .content-Users{
    display: flex;
    align-items: center
} */
.update{
    padding-top: 20%;
}
.update .button-a{
    display: block;
    text-align: center;
    padding: 8px 16px;
    background-color: #535e8e;
    border-radius: 40px;
    text-decoration: none;
    color: #ffffff;
}
input{
    border-color: grey;
    border-radius: 10px;
    width: 200px;
    height: 25px;
}
</style>

<body>
    <div class="all">
        <div class="content-Users">
            <? if(empty($_GET['update'])){ ?>
                <div class="AlluserIMG"><img src="../../imgDefolt/imgUsers/<?=$_SESSION['img']?>" width="100px"></div>
                <div class="Alluser"><?= $_SESSION['name'] ?></div>
                <div class="update"><a class="button-a" href="?update=1">Редактировать</a></div>
            <? } else if(isset($_GET['update'])){ ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="Alluser">
                        <input type="text" required="required" name="name" value="<?= $_SESSION['name'] ?>">
                    </div>
                    <div class="AlluserIMG"><img src="/img/imgUsers/<?=$_SESSION['imgUser']?>" width="100px">
                        <input type="file" name="file">
                    </div>
                    <div class="update">
                        <input type="submit" value="Update" name="Update">
                    </div>
                </form>
            <? }?>
        </div>
    </div>
</body>