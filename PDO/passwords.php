<?php
function generateHash($pass){
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    return $hash;
}
function checkPassword($pass, $hash){
    return password_verify($pass,$hash);
}
