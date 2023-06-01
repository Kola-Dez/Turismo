<?php
class Conect{
    private static $pdo;

    public function __construct($host = 'localhost', $dbname = 'Turismo', $username = 'root', $password = '') {
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Дополнительные настройки PDO можно указать здесь
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public function selectFun($structureName, $stolb){
        $query = "SELECT * FROM $structureName";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $key){
            $mass[] = $key[$stolb];
        }
        return $mass;
    }
    public function regFun($structureName, $name, $email, $password)
    {
        // Проверка, существует ли пользователь с таким же именем
        $query = self::$pdo->prepare("SELECT COUNT(*) FROM $structureName WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        $count = $query->fetchColumn();
    
        if ($count > 0) {
            echo "Электронная почта уже существует в базе данных.<br>";
        } else {
            $query = self::$pdo->prepare("SELECT COUNT(*) FROM $structureName WHERE name = :name");
            $query->bindParam(':name', $name);
            $query->execute();
            $count = $query->fetchColumn();
    
            if ($count > 0) {
                echo "Пользователь с таким именем уже существует.";
            } else {
                // Вставка нового пользователя в базу данных
                $query = self::$pdo->prepare("INSERT INTO $structureName (name, email, password) VALUES (:name, :email, :password)");
                $query->bindValue(':name', $name);
                $query->bindValue(':email', $email);
                $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
                $query->execute();
                echo "Регистрация прошла успешно!";
            }
        }
    }
    public function logFun($structureName, $name, $password){
        $stmt = self::$pdo->prepare("SELECT * FROM $structureName WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            // Аутентификация прошла успешно, устанавливаем сессию
            return $user;
        } else {
            echo "Неверное имя пользователя или пароль.";
        }
    }
    
   
    

};




?>