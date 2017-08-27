<?php
$session = $app->session;
$db = $app->db;

$content = '<div class="alert alert-danger" role="alert">User name or password is incorrect, Try again</div>';

// Handle incoming POST variables
$user_name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;
$user_pass = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;
$sql = "SELECT * FROM users WHERE username LIKE ?;";


// Correspond according to input
// Check if both fields are filled
if ($user_name != null && $user_pass != null) {
    // Check if username exists
    $resultset = $db->executeFetch($sql, [$user_name]);
    $array = json_decode(json_encode($resultset), True);
    $password = $array["password"];

    // Verify user password
    if (password_verify($user_pass, $password)) {
        $session->set("name", $user_name);
        header("Location: profile");
    } else {
        // Redirect to login.php
        echo $content;
    }
}
