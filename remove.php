<?php
$pdo = new PDO('mysql:host=localhost; port=3306; dbname=company' , 'root' , '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sno = $_POST['sno'] ?? null;
if(!$sno){
    header("Location: index.php");
    exit();
}

$statement = $pdo->prepare('DELETE FROM orders WHERE sno = :sno');
$statement->bindValue(':sno', $sno);
$statement->execute();

header("Location: index.php");
?>