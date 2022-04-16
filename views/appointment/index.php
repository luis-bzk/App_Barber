<?php
    include_once __DIR__ . '/../templates/bar.php'
?>
<h1 class="page-name">Create New Reservation</h1>
<p class="page-description">Take services for your appointment</p>


<div id="app" class="app">
    <nav class="tabs">
        <button type="button" data-step="1">Services</button>
        <button type="button" data-step="2">Information</button>
        <button type="button" data-step="3">Summary</button>
    </nav>

    <section id="step-1" class="section">
        <h2 class="section__title">Services</h2>
        <p class="section__text">Select your services</p>

        <div id="services" class="service-list"></div>
    </section>

    <section id="step-2" class="section">
        <h2 class="section__title">Data user and appointment</h2>
        <p class="section__text">Set your appointment data</p>

        <form action="" class="form">
            <div class="field">
                <label for="name">Name</label>
                <input
                        type="text"
                        id="name"
                        placeholder="Insert the name"
                        value="<?php echo $name; ?>"
                        disabled/>
            </div>

            <div class="field" id="dateInput">
                <label for="date">Date</label>
                <input
                        type="date"
                        id="date"
                        min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"/>
            </div>

            <div class="field"  id="timeInput">
                <label for="hour">Hour</label>
                <input
                        type="time"
                        id="hour" />
            </div>
            <input type="hidden" id="id" value="<?php echo $id ;?>">
        </form>
    </section>

    <section id="step-3" class="section summaryContent">
        <h2 class="section__title">Summary</h2>
        <p class="section__text" id="text-summary">Check the information</p>
        <div class="appointment"></div>
    </section>


    <!--pagination-->
    <div class="pagination">
        <button
                id="before"
                class="button-form"
        >&laquo; Previous</button>

        <button
                id="after"
                class="button-form"
        >Next &raquo;</button>
    </div>
</div>

<?php
$script="
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
";
?>