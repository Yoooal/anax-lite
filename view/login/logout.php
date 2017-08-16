<?php
$session = $app->session;

// Check if someone is logged in
if ($session->has("name")) {
    $session->destroy();
    header("Location: ");
}

// Check if session is active
$has_session = session_status() == PHP_SESSION_ACTIVE;

if (!$has_session) {
    echo "<p>The session no longer exists. You have successfully logged out!</p>";
}

?>
<div class="alert alert-danger" role="alert">You have logged out</div>
