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
        $query = "DELETE FROM $structureName WHERE id = $id";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
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