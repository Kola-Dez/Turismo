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
                
                $newFileName = uniqid() . "_" .  $_FILES['file']['name'];
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
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <!-- Admin Style -->
  <link rel="stylesheet" href="adminStyle.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/views/contact/contact.php" class="nav-link">Contact</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/imgDefolt/DefoltFoto/logoa.png" style="width:100%;">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Пользователи</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?places" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Статьи</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Настройки</p>
                </a>
              </li>
            </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class=" mb-1">
          <div>
            <h1 style="text-align:center;"><?php if(isset($_GET["users"])){echo "Пользователи";}else if(isset($_GET["places"])){echo "Статьи";}else {echo "Welcome";} ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div style="text-align:center;" class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
          <div class="content">
            
          <?php if(isset($_GET['users'])){?>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>img</th>
                <th>Действия</th>
            </tr>
            <?php foreach ($allUsers as $key) { ?>
                <tr>
                    <td><?= $key['id'] ?></td>
                    <td><?= $key['name'] ?></td>
                    <td><?= $key['email'] ?></td>
                    <td><?= $key['imgUser'] ?></td>
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
                                <div>
                                <label for="Иссык-Кульская">Иссык-Кульская</label>
                                <input type="radio" id="huey" name="region" value="Иссык-Кульская" checked>
                                </div>

                                <div>
                                    
                                    <label for="Чуйская">Чуйская</label>
                                    <input type="radio" id="louie" name="region" value="Чуйская">
                                </div>

                                <div>
                                    
                                    <label for="Таласская">Таласская</label>
                                    <input type="radio" id="louie" name="region" value="Таласская">
                                </div>

                                <div>
                                    
                                    <label for="Нарынская">Нарынская</label>
                                    <input type="radio" id="louie" name="region" value="Нарынская">
                                </div>

                                <div>
                                    
                                    <label for="Ошская">Ошская</label>
                                    <input type="radio" id="louie" name="region" value="Ошская">
                                </div>

                                <div>
                                    
                                    <label for="Джалал-Абадская">Джалал-Абадская</label>
                                    <input type="radio" id="louie" name="region" value="Джалал-Абадская">
                                </div>

                                <div>
                                    
                                    <label for="Джалал-Абадская">Баткенская</label>
                                    <input type="radio" id="louie" name="region" value="Джалал-Абадская">
                                </div>
                            </td>


                            <td>
                                <input style="width:250px;" type="file" name="file">
                            </td>

                            <td><input class="button" type="submit" name="Creat" value="Добавить"></td>
                        </tr>
                </table>
            </form>
        <?php } ?>

            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
