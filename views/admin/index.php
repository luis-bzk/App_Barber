<?php

use Model\Appointment;

include_once __DIR__ . '/../templates/bar.php'
?>
<h1 class="page-name">Administration Panel</h1>
<p class="page-description">Search for appointments</p>

<div class="search">
    <form action="" class="formulary">
        <div class="field">
            <label for="date">
                Date
            </label>
            <input 
                type="date" 
                id="date" 
                name="date"
                value="<?php echo $date; ?>"/>
        </div>

    </form>
</div>

<?php
    if(count($appointments) === 0){
        echo "<h2>Not appointments</h2>";
    }
?>

<div id="appointments-admin">
    <ul class="appointments">
        <?php
        $appointId = 0;
        foreach($appointments as $key =>  $appointment){
            
            if($appointId !== $appointment->id){
                $total = 0;
            ?>
            
            <li>
                <h2>Appointment</h2>
                <div class="appointments__data">
                    <div class="appointments__user">
                        <h3>Data</h3>
                        <p>Id: <span><?php echo $appointment->id?></span></p>
                        <p>Hour: <span><?php echo $appointment->hour?></span></p>
                        <p>Customer: <span><?php echo $appointment->customer?></span></p>
                        <p>Email: <span><?php echo $appointment->email?></span></p>
                        <p>Phone: <span><?php echo $appointment->phone?></span></p>
                    </div>
                    <div class="appointments__service">
                        <h3>Services</h3>
                <?php
                $appointId =$appointment->id;
            } 
            $total += $appointment->price;
            ?> 
                        <p class="service"><?php echo $appointment->service . ' $' . $appointment->price?></p>
            <?php
            $current = $appointment->id;
            $next = $appointments[$key+1]->id ?? 0;
            
            if(isLast($current, $next)){
                ?>

                <p class="total">Total: <span>$ <?php echo $total ?></span></p>

                <form action="/api/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $appointment->id; ?>">
                    <input type="submit" class="button-delete" value="Delete">
                </form>

                <?php
            }
        } 
        ?> 

    </ul>
</div>

<?php
    $script = "<script src='build/js/search.js'></script>"
?>