<?php

include 'db.php';
$tab = $_POST['tab'];

if (!empty($_POST['tab']) ) {
    if($tab === 'images') {
        echo "<input type='text' name='search' placeholder='ex: gloat%.png'><br/>";
        echo "<button type='submit' name='submit'>SEARCH</button>";
    }
    else {
        echo "<input type='text' name='search' placeholder='ex: names%local%unfill'><br/>";
        echo "<button type='submit' name='submit'>SEARCH</button>";
    }
}
    

?>