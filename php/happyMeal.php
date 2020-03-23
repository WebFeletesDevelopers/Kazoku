<?php
// ENCRYPT
function addUser($name, $username, $password){
    $sql = "INSERT INTO `users` (`name`, `username`, `password`) VALUES (?,?,?)";
    $this->stmt = $this->pdo->prepare($sql);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $this->stmt->execute([$name, $username, $hash]);
}

$pass = addUser("John Doe", "john@doe.com", "password123");

// VERIFY
function login($username, $password){
    $sql = "SELECT * FROM `users` WHERE `username`=?";
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute([$username]);
    $user = $this->stmt->fetchAll();
    return password_verify($password, $user['password']);
}

$valid_user = login($_POST['email'], $_POST['password']);
?>