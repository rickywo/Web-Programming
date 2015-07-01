<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width; initial-scale=1.0" />
      <title>SILVERADO CINEMA</title>
      <link href='https://fonts.googleapis.com/css?family=Jura:500' rel='stylesheet' type='text/css'>
      <link href="https://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
      <script src="app/views/cartjs.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <style>
          <?php require_once('css/style.css'); ?>
          <?php require_once('css/modaldialog.css'); ?>
      </style>
  </head>
  <body>

    <header>
        <img class="head-logo" src="app/views/img/logo.png" alt="Logo" height="90" width="290"/>
    </header>
    <?php
        include("CShare.php");
        echo CShare::GenerateShareBtn($links);
        require_once("navibar.php");
    ?>
    <main>
        <div class="column">
            <div class="column-sub">
            <img class="banner" src="app/views/img/tdk.jpg">
                <!-- Original image below sourced for educational purposes: http://www.thedarkknightrises.com/ -->
            <h1>grant reopening</h1>
            <p>After weeks of waiting, the grant reopening is going to happen soon. Everyone is welcome. The new comfy seats, high quality screens, and the ultimate surround sound are going to be introduced to you. That's the brand new experience!</p>
            </div>
            <div class="column-sub">
                <h1>Price List</h1>
                <?php
                    include("CPriceTable.php");
                    echo CPriceTable::GeneratePriceTable($prices);
                ?>
                <h1>Weekly schedule</h1>
                <?php
                    include("CGenreTable.php");
                    echo CGenreTable::GenerateGenreTable($sessions);
                ?>
            </div>
        </div>
        <?php
            include("CAdColumn.php");
            echo CAdColumn::GenerateAdColumn($ads);
        ?>
    </main>
  <?php require_once("footer.php"); ?>
  </body>
</html>