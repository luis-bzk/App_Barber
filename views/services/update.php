<?php
    include_once __DIR__ . '/../templates/bar.php'
?>

<h1 class="page-name">Update Service</h1>
<p class="page-description">Change Sata Service</p>

<?php
    include_once __DIR__ . '/../templates/alerts.php'
?>

<form method="POST" class="form">
    <?php
    include_once __DIR__ . '/form.php';
    ?>
    <input type="submit" class="button-form" value="Save changes">
</form>