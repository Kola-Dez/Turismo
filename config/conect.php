<?php
class Conect{
    private $pdo;

    public function __construct($host = 'localhost', $dbname = 'Turismo', $username = 'root', $password = '') {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Дополнительные настройки PDO можно указать здесь
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public function selectFun($structureName, $stolb){
        $query = "SELECT * FROM $structureName";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $key){
            $mass[] = $key[$stolb];
        }
        return $mass;
    }
    
    
   
    

};




?>