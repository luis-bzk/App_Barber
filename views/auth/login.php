<h1 class="page-name">Login</h1>
<p class="page-description">Use your account</p>

<?php
include_once __DIR__ . "/../templates/alerts.php";
?>

<form method="post" action="/" class="form">
    <div class="field">
        <label for="email">Email</label>
        <input
                type="email"
                id="email"
                placeholder="Your email"
                name="email"
        />
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input
                type="password"
                id="password"
                placeholder="Your password"
                name="password"
        />
    </div>

    <input type="submit" value="Login" class="button-form">

</form>
<div class="actions">
    <a href="/create-account">Don't have an account? <span>Create one</span></a>
    <a href="/forgot-password">I forgot my password</a>
</div>