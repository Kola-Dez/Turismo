<?php
session_start();
require_once 'conect.php';
class ClassAdmin extends conect{

    public function All($structureName){
        $query = "SELECT * FROM $structureName";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $all;
    }

    public function Delite($structureName, $id){


        $filename = "SELECT `img` FROM $structureName WHERE `id` = $id";
        $stmt = self::$pdo->prepare($filename);
        $stmt->execute();
        $all = $stmt->fetch(PDO::FETCH_ASSOC);
        $filename = '/img/'.$all['img'];
        print_r($filename);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $filename)) {
            if (unlink($_SERVER['DOCUMENT_ROOT'] . $filename)) {
                $query = "DELETE FROM $structureName WHERE id = $id";
                $stmt = self::$pdo->prepare($query);
                $stmt->execute();
                echo 'Файл успешно удален.';
            } else {
                echo 'Ошибка при удалении файла.';
            }
        } else {
            echo "Файл не существует";
        }
    }

    public function UpdatePlaces($structureName, $id, $name, $price, $region, $img){
        $query = "UPDATE `$structureName` SET `name`='$name',`price`='$price',`region`='$region',`img`='$img' WHERE `id`='$id'";
        self::$pdo->query($query);
    }
    

    public function CreatPlaces($structureName, $name, $price, $region, $img){
    $query = self::$pdo->prepare("INSERT INTO $structureName (name, price, region, img) VALUES (:name, :price, :region, :img)");
    $query->bindValue(':name', $name);
    $query->bindValue(':price', $price);
    $query->bindValue(':region', $region);
    $query->bindValue(':img', $img);
    $query->execute();
    }
};  
?>