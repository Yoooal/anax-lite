<?php
$session = $app->session;
$db = $app->db;
$db->connect();

$user = $session->get("name");
$status = "Change password";

// Handle incoming POST variables
$old_pass = isset($_POST["old_pass"]) ? htmlentities($_POST["old_pass"]) : null;
$new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;

// Check if all fields are filled
if ($old_pass != null && $new_pass != null && $re_pass != null) {
    // Check if old password is correct
    if (password_verify($old_pass, $db->getHash($user))) {
        // Check if new password matches
        if ($new_pass == $re_pass) {
                $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $db->changePassword($user, $crypt_pass);
                $status = "Password changed.";
        } else {
            $status = "The passwords do not match.";
        }
    } else {
        $status = "Old password is incorrect.";
    }
} else {
    $status = "All fields must be filled.";
}

?>

<!doctype html>
<head>
    <meta charet="utf-8">
    <title>Change password</title>
</head>
<body>
    <form action="change_password.php" method="POST">
        <table>
            <legend><h3><?=$status?></h3></legend>
            <tr>
                <td>Old pass:</td><td><input type="password" name="old_pass"></td>
            </tr>
            <tr>
                <td>New pass:</td><td><input type="password" name="new_pass"></td>
            </tr>
            <tr>
                <td>Re-enter pass:</td><td><input type="password" name="re_pass"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submitForm" value="Change password"></td>
            </tr>
        </table>
    </form>
    <p><a href='login.php'>Back to login</a></p>

</body>
</html>
