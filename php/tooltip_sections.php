<?php

include 'db.php';
$class_name = $_POST['class_name'];
$class_name = "'".$class_name."'";
$array = [];

$data = $db->query("SELECT * from tooltips where class_name = $class_name");

function template($array, $db, $class_name, $innate, $bottom, $get_cooldown) {
    if($array !== NULL) {
        foreach ($array as $property) {
            if ((($property !== 'AbilityCooldown')) && !$get_cooldown) {
                $info = $db->query("SELECT * from item_filters where class_name = $class_name and property = '$property' and stat_value not in (0)");
                $info = $info->fetch_assoc();
                if ($info !== NULL) {
                    if ($innate) {
                        innate($info, $bottom);
                    }
                    else {
                        important_grid($info, $db);
                    }
                }
                
            }
            elseif ((($property === 'AbilityCooldown') || ($property === 'AbilityChargeUpTime')) && $get_cooldown) {
                $info = $db->query("SELECT * from item_filters where class_name = $class_name and property = '$property' and stat_value not in (0)");
                $info = $info->fetch_assoc();
                if ($info !== NULL) {
                    return $info['stat_value_display'];
                }
                
            }
        }
    }
}

function innate($info, $bottom) {
    if (($info['stat_value'] !== NULL) && ($info['stat_value'] !== 0)) {
        /* $no_spaces = $info['postfix'];
        $no_spaces = str_replace(' ', '', $no_spaces); */
        echo "<div>";
        if (!$bottom) {
            if (!str_contains($info['stat_value_display'], '-')) {
                echo '+';
            }
        }
        
        /* if (($info['stat_value'] > 0) && $positive) {
            echo "+";
        } */
        echo $info['stat_value_display'];
        if (!str_contains($info['stat_value_display'], 'm')) {
            echo $info['postfix'];
        }
        echo " {$info['label']}";
        echo "</div>";
    }
}

function important_grid($info, $db) {
    if (($info['stat_value'] !== NULL) && ($info['stat_value'] !== 0) && ($info['label'] !== NULL)) {
        echo "<div class='important-property'>";
        echo "<div>";
        
        $property = $info['property'];
        $icons = $db->query("SELECT * from tooltip_icons where property = '$property'");
        $icons = $icons->fetch_assoc();
        if ($icons !== NULL) {
            echo "<img src='{$icons['filepath']}'>";
        }
    
        if ($info['stat_value'] > 0) {
            if (($info['prefix'] === '+') || ($info['prefix'] === '{s:sign}')) {
                echo '+';
            }
            elseif ($info['prefix'] === '-') {
                echo $info['prefix'];
            }
        }
        
        echo $info['stat_value_display'];
        
        if (!str_contains($info['stat_value_display'], 'm')) {
            echo $info['postfix'];
        }
        echo '<br>';
        echo " {$info['label']}";

        echo '<br>';
        if (!empty($info['conditional'])) {
            echo "<div class='conditional'>Conditional</div>";
        }
        echo "</div>";
        
    }
    if (($info['stat_scale'] !== NULL) && ($info['stat_scale'] !== '0.0')) {
        echo "<div class='scaling-items'>";
        if (($info['stat_scale_type'] === 'ETechPower') || ($info['class_name'] === 'upgrade_health_stimpak') || ($info['stat_scale'] === '0.04')) {
            echo "<img src='./icons/keystat_spirit_arrow.png'><br>";
        }
        else {
            echo "<img src='./icons/keystat_boon_arrow.png'><br>";
        }
        echo "x {$info['stat_scale']}";
        echo "</div>";
    }
    echo "</div>";
}

while($row = $data->fetch_assoc()){
    if ($row['section_type'] === 'innate'){
        $array = json_decode($row['elevated_properties']);
        template($array, $db, $class_name, true, false, false);

        $array = json_decode($row['properties']);
        template($array, $db, $class_name, true, false, false);
    }
    else {
        $array = json_decode($row['properties']);
        $cd = template($array, $db, $class_name, false, false, true);
        if (($row['section_type'] === 'passive') || ($row['section_type'] === NULL)) {
            $header = 'Passive';
        }
        else {
            $header = 'Active';
        }
        
        if ($cd) {
            echo "<div class='section-header'>{$header}<div><img src='./icons/cooldown.svg'>{$cd}s</div></div>";
            echo $row['loc_string'];
            echo '<br>';
        }
        else {
            echo "<div class='section-header'>{$header}</div>";
            echo $row['loc_string'];
            echo '<br>';
        }
        

        
        if ($row['important_properties'] !== NULL) {
            echo "<div class='section-grid'>";
            $array = json_decode($row['important_properties']);
            template($array, $db, $class_name, false, false, false);
            echo "</div>";
        }
        elseif (($row['important_properties'] === NULL) && ($row['properties'] === NULL)) {
            echo "<div class='section-grid'>";
            $array = json_decode($row['elevated_properties']);
            template($array, $db, $class_name, false, false, false);
            echo "</div>";
        }
        else {
            echo "<div class='horizontal-grid'>";
            $array = json_decode($row['properties']);
            template($array, $db, $class_name, true, false, false);
            echo "</div>";
        }
        
        if (($row['important_properties'] !== NULL) || ($row['elevated_properties'] !== NULL)) {
            $array = json_decode($row['properties']);
            echo "<div class='bottom-grid'>";
            template($array, $db, $class_name, true, true, false);
            echo "</div>";
        }
    }
}