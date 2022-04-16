<?php
    include_once __DIR__ . '/../templates/bar.php'
?>

<h1 class="page-name">New Service</h1>
<p class="page-description">Create a new service</p>

<?php
    include_once __DIR__ . '/../templates/alerts.php'
?>
<form action="/services/create" method="POST" class="form">
    <?php
    include_once __DIR__ . '/form.php';
    ?>
    <input type="submit" class="button-form" value="Save service">
</form>