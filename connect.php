<?php
try{
    $pdo = new PDO(
    	"mysql:host=localhost;dbname=site_marlin;",
    	"root",
    	"mysql",
    	[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
        echo 'Невозможно установить соединение с базой данных.';
}
    
    
