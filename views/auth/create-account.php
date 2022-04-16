<h1 class="page-name">Create account</h1>
<p class="page-description">Complete the form to create your account</p>

<?php
include_once __DIR__ . "/../templates/alerts.php";
?>
<form method="post" action="/create-account" class="form">
    <div class="field">
        <label for="name">Name:</label>
        <input
                type="text"
                id="name"
                placeholder="Your name"
                name="name"
                value="<?php echo s($user->name)?>"
        />
    </div>
    <div class="field">
        <label for="lastname">Lastname:</label>
        <input
                type="text"
                id="lastname"
                placeholder="Your lastname"
                name="lastname"
                value="<?php echo s($user->lastname)?>"
        />
    </div>
    <div class="field">
        <label for="phone">Phone:</label>
        <input
                type="tel"
                id="phone"
                placeholder="Your phone number"
                name="phone"
                value="<?php echo s($user->phone)?>"
        />
    </div>
    <div class="field">
        <label for="email">E-mail:</label>
        <input
                type="email"
                id="email"
                placeholder="Your e-mail"
                name="email"
                value="<?php echo s($user->email)?>"
        />
    </div>
    <div class="field">
        <label for="password">Password:</label>
        <input
                type="password"
                id="password"
                placeholder="Your password"
                name="password"
        />
    </div>

    <input type="submit" value="Create account" class="button-form">

    <div class="actions">
        <a href="/">Do you have an account? <span>Login</span></a>
        <a href="/forgot-password">I forgot my password</a>
    </div>

</form>