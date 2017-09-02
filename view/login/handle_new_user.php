<?php
$db = $app->db;
$db->connect();

// Handle incoming POST variables
$user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
$user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
$userLevel = isset($_POST["userLevel"]) ? htmlentities($_POST["userLevel"]) : null;


if ($user_name != null && $user_pass != null && $re_user_pass != null && $userLevel != null) {
    if ($user_pass == $re_user_pass) {
        $crypt_pass = password_hash($user_pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, userLevel) VALUES (?, ?, ?);";
        $db->execute($sql, [$user_name, $crypt_pass, $userLevel]);
        $usersId = $db->lastInsertId();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
