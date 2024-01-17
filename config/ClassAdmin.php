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

    public function Delete($structureName, $id) {
        try {
            // Fetch the image filename associated with the record
            $stmt = self::$pdo->prepare("SELECT `img` FROM $structureName WHERE `id` = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $filename = '/img/' . $result['img'];
                
                // Check if the file exists
                $file_path = $_SERVER['DOCUMENT_ROOT'] . $filename;
                if (file_exists($file_path)) {
                    // Delete the file
                    if (unlink($file_path)) {
                        // Delete the database record
                        $stmt = self::$pdo->prepare("DELETE FROM $structureName WHERE id = :id");
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        echo 'File and record deleted successfully.';
                    } else {
                        echo 'Error deleting the file.';
                    }
                } else {
                    echo 'File does not exist.';
                }
            } else {
                echo 'Record not found.';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    public function UpdatePlaces($structureName, $id, $name, $price, $region, $img){
        $query = "UPDATE `$structureName` SET `name`='$name',`price`='$price',`region`='$region',`img`='$img' WHERE `id`='$id'";
        self::$pdo->query($query);
    }
    

    public function CreatPlaces($structureName, $name, $price, $region, $img){
        $query = self::$pdo->prepare("INSERT INTO $structureName (`name`, `price`, `region`, `img`) VALUES (:name, :price, :region, :img)");
        $query->bindValue(':name', $name);
        $query->bindValue(':price', $price);
        $query->bindValue(':region', $region);
        $query->bindValue(':img', $img);
        $query->execute();
    }
    
};  
?>