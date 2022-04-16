<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/ico" href="build/img/favicon.ico">
    <!-- font awsome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css-->
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Barber</title>
</head>
<body>

    <div class="container-app">
        <div class="image">
        </div>

        <div class="app">
            <?php echo $contenido;?>
        </div>


    </div>

    <?php echo $script ?? '';
    ?>

</body>
</html>