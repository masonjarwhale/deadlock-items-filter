<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deadlock Item Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="./icons/viscous_goo_puddle.svg">
    <link href='/items/images_icons.css' rel='stylesheet'>
</head>

<?php
//db variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deadlock_items";
$table = 'images';

//connecting to the db 
$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

//handles dynamic backgrounds in the icon/images tab
$background_data = $db->query("SELECT * FROM `images` WHERE image_filepath NOT LIKE '%test%' AND image_filepath IN (SELECT image_filepath FROM `images` WHERE image_filepath LIKE '%grounds%') AND image_filepath IN (SELECT image_filepath FROM `images` WHERE image_filepath LIKE '%webp%') ORDER BY RAND() LIMIT 1") or die($db->error);
$background_data = $background_data->fetch_assoc()



 
?>

<body style="background-image: url(&quot;<?php echo "{$background_data['image_filepath']}"; ?>&quot;)">
    <div class="layout-container">

        <div class="nav-container">
            <div class="home">
                <a href="http://localhost/items/index.php">HOME</a>
            </div>

            <div class="about">
                <a href="http://localhost/items/about.php">ABOUT</a>
            </div>

            <div class="images">
                <a href="http://localhost/items/images.php">IMAGES</a>
            </div>
            
            <div class="icons">
                <a href="http://localhost/items/icons.php">ICONS</a>
            </div>
            
        </div>





        <div class="layout">

            <div class="search-title"><h2>IMAGES</h2></div>

            <div class="search-container">
                <form method="POST">
                    <input type="text" name="search"><br/>
                    <button type="submit" name="submit">SEARCH</button>
                </form>
            </div>

            <?php
                if(isset($_POST['submit'])) {
                    header("Location: http://localhost/items/images.php/?search={$_POST['search']}");
                    exit();

                }

            ?>

            
            




            <div class="item-grid-container">
                <div class="item-grid">
                    <?php
                    if (!empty($_GET['search']) ) {
                        $search = $_GET['search'];

                        $image_data = $db->query("SELECT * FROM $table where image_name like '%$search%'") or die($db->error);
                        while($row = $image_data->fetch_assoc()){
                            echo "<a href='{$row['image_filepath']}'><image class='item' src='{$row['image_filepath']}'></image></a>";
                        }
                    }
                    else {
                        $image_data = $db->query("SELECT * FROM $table") or die($db->error);
                        while($row = $image_data->fetch_assoc()){
                            echo "<a href='{$row['image_filepath']}'><image class='item' src='{$row['image_filepath']}'></image></a>";
                        }

                    }
                    
                    $db->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>