<h1 class="page-name">reset your password</h1>
<p class="page-description">Complete the form to reset your account</p>

<?php
include_once __DIR__ . "/../templates/alerts.php";
?>
<?php if($error) return; ?>
    <form method="post" class="form">


        <div class="field">
            <label for="password">Password:</label>
            <input
                type="password"
                id="password"
                placeholder="Enter a new password"
                name="password"
            />
        </div>


        <input type="submit" value="Recover password" class="button-form">

        <div class="actions">
            <a href="/">Do you have an account? <span>Login</span></a>
            <a href="/create-account">Don't have an account? <span>Create one</span></a>
        </div>

    </form>

