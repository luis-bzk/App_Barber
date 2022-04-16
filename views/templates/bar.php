<div class="bar">
    <p>Hello <span><?php echo $name ?? ''; ?></span></p>
    <a class="button-form" href="/logout">Logout</a>
</div>

<?php
if (isset($_SESSION['admin'])) {
?>

<div class="services-bar">
    <a class="button-bar" href="/admin">See Appointments</a>
    <a class="button-bar" href="/services">See Services</a>
    <a class="button-bar" href="/services/create">New service</a>
</div>

<?php
}
?>