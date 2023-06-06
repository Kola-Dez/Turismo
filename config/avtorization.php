<?php
session_start();
require_once 'conect.php';
class avtorization extends conect
{    
    public function selectFun($structureName){
        $query = "SELECT * FROM $structureName";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function selectFunNAME($structureName, $name){
        $stmt = self::$pdo->prepare("SELECT * FROM $structureName WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $user = $stmt->fetch();
        return $user;
    }

    public function regFun($structureName, $name, $email, $password, $imgUser)
    {
        // Проверка, существует ли пользователь с таким же именем
        $query = self::$pdo->prepare("SELECT COUNT(*) FROM $structureName WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $count = $query->fetchColumn();
        if ($count > 0) {
            return "1";
        } else {
            $count = 0;
            $query = self::$pdo->prepare("SELECT COUNT(*) FROM $structureName WHERE name = :name");
            $query->bindParam(':name', $name);
            $query->execute();
            $count = $query->fetchColumn();
            if ($count > 0) {
                return "2";
            } else { 
                // Вставка нового пользователя в базу данных
                $query = self::$pdo->prepare("INSERT INTO $structureName (name, email, password, imgUser) VALUES (:name, :email, :password, :imgUser)");
                $query->bindValue(':name', $name);
                $query->bindValue(':email', $email);
                $query->bindValue(':imgUser', $imgUser);
                $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
                $query->execute();
                return 3;
            }
        }
    }
    public function logFun($structureName, $name, $password){
        $stmt = self::$pdo->prepare("SELECT * FROM $structureName WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            // Аутентификация прошла успешно, устанавливаем сессию
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['imgUser'] = $user['imgUser'];
            return 1;
        } else {
            return 2;
        }
    }
    public function IdCheckFun($structureName, $name){
        $stmt = self::$pdo->prepare("SELECT * FROM $structureName WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $user = $stmt->fetch();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
    }
    public function UpdateUser($structureName, $id, $name, $imgUser){
        $query = "UPDATE `$structureName` SET `name`='$name', `imgUser`='$imgUser' WHERE `id`='$id'";
        self::$pdo->query($query);
    }
  
}
?>