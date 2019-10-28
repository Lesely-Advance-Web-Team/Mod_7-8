<!DOCTYPE html>
<html>
<head>
        <title>Mod7 Custom CSM</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="svg-container">
    <!-- I crated SVG with: https://codepen.io/anthonydugois/pen/mewdyZ -->
    <svg viewbox="0 0 800 400" class="svg">
      <path id="curve" fill="#50c6d8" d="M 800 300 Q 400 350 0 300 L 0 0 L 800 0 L 800 300 Z">
      </path>
    </svg>
  </div>

    <?php include 'header.php' ?>
    <?php include 'nav.php' ?>
    <main>
        <?php
        $mysqli = new mysqli('localhost','root','Secur3Passw0rd!','images') or die($mysqli->connect_error);
        $table = 'fashion';
        
        $result = $mysqli->query("SELECT * FROM $table") or die($mysqli->error);
        
        while ($data = $result->fetch_assoc()){
            echo "<h2>{$data['name']}</h2>";
            echo "<img src='{$data['img_dir']}' width='40%' height='40%'>";
        }
        
        ?>
        </main>

        <?php include 'header.php' ?>
        
    </body>
