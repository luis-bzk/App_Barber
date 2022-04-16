<h1 class="page-name">Forgot my password</h1>
<p class="page-description">Enter your email for reset the password</p>

<?php
include_once __DIR__ . "/../templates/alerts.php";
?>

<form method="post" action="/forgot-password" class="form">
    <div class="field">
        <label for="email">E-mail:</label>
        <input
            type="email"
            id="email"
            placeholder="Your e-mail"
            name="email"
        />
    </div>

    <input type="submit" value="Send code" class="button-form">

</form>
<div class="actions">
    <a href="/">Do you have an account? <span>Login</span></a>

    <a href="/create-account">Don't have an account? <span>Create one</span></a>
</div>