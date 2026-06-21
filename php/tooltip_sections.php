<?php

include 'db.php';
$class_name = $_POST['class_name'];
$class_name = "'".$class_name."'";
$array = [];

$data = $db->query("SELECT * from tooltips where class_name = $class_name");

function template($array, $db, $class_name, $innate, $positive, $get_cooldown) {
    if($array !== NULL) {
        foreach ($array as $property) {
            if ((($property !== 'AbilityCooldown')) && !$get_cooldown) {
                $info = $db->query("SELECT * from item_filters where class_name = $class_name and property = '$property' and stat_value not in (0,1)");
                $info = $info->fetch_assoc();
                if ($info !== NULL) {
                    if ($innate) {
                        innate($info, $positive);
                    }
                    else {
                        important_grid($info);
                    }
                }
                
            }
            elseif ((($property === 'AbilityCooldown') || ($property === 'AbilityChargeUpTime')) && $get_cooldown) {
                $info = $db->query("SELECT * from item_filters where class_name = $class_name and property = '$property' and stat_value not in (0,1)");
                $info = $info->fetch_assoc();
                if ($info !== NULL) {
                    return $info['stat_value'];
                }
                
            }
        }
    }
}

function innate($info, $positive) {
    if (($info['stat_value'] !== NULL) && ($info['stat_value'] !== 0)) {
        echo "<div>";
        if (($info['stat_value'] > 0) && $positive) {
            echo "+";
        }
        echo $info['stat_value'];
        echo $info['postfix'];
        echo " {$info['label']}";
        echo "</div>";
    }
}

function important_grid($info) {
    if (($info['stat_value'] !== NULL) && ($info['stat_value'] !== 0)) {
        echo "<div class='important-property'>";
        echo "<div>";
        echo "<img src='{$info['icon']}'>";
        echo $info['stat_value'];
        echo $info['postfix'];
        echo '<br>';
        echo " {$info['label']}";
        echo "</div>";
        echo "</div>";
    }
}

while($row = $data->fetch_assoc()){
    if ($row['section_type'] === 'innate'){
        $array = json_decode($row['elevated_properties']);
        template($array, $db, $class_name, true, true, false);

        $array = json_decode($row['properties']);
        template($array, $db, $class_name, true, true, false);
    }
    else {
        $array = json_decode($row['properties']);
        $cd = template($array, $db, $class_name, false, false, true);
        if (($row['section_type'] === 'passive') || ($row['section_type'] === NULL)) {
            $upper = 'Passive';
        }
        else {
            $upper = 'Active';
        }
        
        if ($cd) {
            echo "<div class='section-header'>{$upper}<div><img src='./icons/cooldown.svg'>{$cd}s</div></div>";
        }
        else {
            echo "<div class='section-header'>{$upper}</div>";
        }
        echo $row['loc_string'];
        echo '<br>';

        
        if ($row['important_properties'] !== NULL) {
            $array = json_decode($row['important_properties']);
        }
        elseif (($row['important_properties'] === NULL) && ($row['properties'] === NULL)) {
            $array = json_decode($row['elevated_properties']);
        }
        else {
            $array = json_decode($row['properties']);
        }

        echo "<div class='section-grid'>";
        template($array, $db, $class_name, false, false, false);
        echo "</div>";


        if (($row['important_properties'] !== NULL) || ($row['elevated_properties'] !== NULL)) {
            $array = json_decode($row['properties']);
            echo "<div class='bottom-grid'>";
            template($array, $db, $class_name, true, false, false);
            echo "</div>";
        }
    }
}