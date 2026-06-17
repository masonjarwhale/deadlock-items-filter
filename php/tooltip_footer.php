<?php

include 'db.php';
$class_name = $_POST['class_name'];
$class_name = "'".$class_name."'";

$upgrades_to = $db->query("SELECT distinct name FROM item_filters where class_name in (SELECT component_items from components_tofrom where component_items = $class_name)");
echo "UPGRADES TO:<br>";
while($row = $upgrades_to->fetch_assoc()){
    echo "{$row['name']}<br>";
}
echo "<br>";

$upgrades_from = $db->query("SELECT distinct name FROM item_filters where class_name in (SELECT component_items from components_tofrom where class_name = $class_name)");
echo "UPGRADES FROM:<br>";
while($row = $upgrades_from->fetch_assoc()){
    echo "{$row['name']}<br>";
}