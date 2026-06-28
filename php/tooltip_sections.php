<?php

include 'db.php';
$class_name_original = $_POST['class_name'];
$class_name = "'".$class_name_original."'";

$data = $db->query("SELECT * from tooltips where class_name = $class_name");
$cooldown = $db->query("SELECT stat_value FROM item_filters where class_name = $class_name and property = 'AbilityCooldown' and stat_value != 0");
$chargeup = $db->query("SELECT stat_value FROM item_filters where class_name = $class_name and property = 'AbilityChargeUpTime' and stat_value != 0");
$proc_cooldown = $db->query("SELECT stat_value FROM item_filters where class_name = $class_name and property = 'ProcCooldown' and stat_value != 0");
$cooldown = $cooldown->fetch_assoc();
$chargeup = $chargeup->fetch_assoc();
$proc_cooldown = $proc_cooldown->fetch_assoc();

$overrides = ['upgrade_magic_carpet','upgrade_target_stun','upgrade_cloaking_device_active','upgrade_ability_power_shard'];
$property_overrides = ['StatusEffectInvisible','StatusEffectStun','StatusEffectEMP','StatusEffectDisarmed'];

function format_value($value) {
    if ((is_string($value)) && (str_contains($value, 'm'))) {
        $int = trim(substr($value, 0, -1));
        $float = floatval($int);
        $formatted = number_format($float, 2, '.', '');
        $formatted = rtrim(rtrim($formatted, '0'), '.');

        return $formatted . 'm';
    } 
    else {
        $float = floatval($value);
        $formatted = number_format($float, 2, '.', '');

        return rtrim(rtrim($formatted, '0'), '.');
    }
}

function get_main_grid($array, $db, $class_name, $property_overrides) {
    $output = '';
    foreach ($array as $property) {
        if (in_array($property, $property_overrides)) {
            $info = $db->query("SELECT * from property_overrides where property = '$property'");
            $info = $info->fetch_assoc();

            $output .= "<div class='flex-item'>";
            $output .= "<div>";
            $output .= "<img src='{$info['filepath']}'>";
            $output .= "{$info['label']}";
            $output .= "<div class='conditional'>{$info['caption']}</div>";
            $output .= "</div></div>";
        }
        else {
            $info = $db->query("SELECT * from item_filters where class_name = $class_name and property = '$property' and stat_value != 0 and stat_value is not NULL");

            if ($info = $info->fetch_assoc()) {
                if ($info['label']) {
                    $output .= "<div class='flex-item'>";
                    if ($info['negative_attribute']) {
                        $output .= "<div class='negative-attribute'>";
                    }
                    else {
                        $output .= "<div>";
                    }
                    
                    $property = $info['property'];
                    $icons = $db->query("SELECT * from tooltip_icons where property = '$property'");
                    $icons = $icons->fetch_assoc();
                    if ($icons !== NULL) {
                        $output .= "<img src='{$icons['filepath']}'>";
                    }
                
                    if ($info['stat_value'] > 0) {
                        if (($info['prefix'] === '+') || ($info['prefix'] === '{s:sign}')) {
                            $output .= '+';
                        }
                        elseif ($info['prefix'] === '-') {
                            $output .= $info['prefix'];
                        }
                    }
                    
                    $output .= format_value($info['stat_value_display']);
                    
                    if (!str_contains($info['stat_value_display'], 'm')) {
                        $output .= $info['postfix'];
                    }
                    $output .= '<br>';
                    $output .= " <div class='important-label'>{$info['label']}</div>";
                    if (!empty($info['conditional'])) {
                        $output .= "<div class='conditional'>Conditional</div>";
                    }
                    $output .= "</div>";
                }
                if (($info['stat_scale'] !== NULL) && ($info['stat_scale'] !== 0)) {
                    $output .= "<div class='scaling-items'>";
                    if (($info['stat_scale_type'] === 'ETechPower') || ($info['class_name'] === 'upgrade_health_stimpak') || ($info['stat_scale'] === '0.04')) {
                        $output .= "<img src='./icons/keystat_spirit_arrow.png'><br>";
                    }
                    else {
                        $output .= "<img src='./icons/keystat_boon_arrow.png'><br>";
                    }
                    $output .= "x {$info['stat_scale']}";
                    $output .= "</div>";
                }
                $output .= "</div>";
            }
        }
        
    }
    return $output;

}

function get_properties($array, $db, $class_name, $innate) {
    $output = '';
    foreach ($array as $property) {
        if ((($property !== 'AbilityCooldown') && ($property !== 'AbilityChargeUpTime'))) {
            $info = $db->query("SELECT * from item_filters where class_name = $class_name and property = '$property' and stat_value != 0 and stat_value is not NULL");
            
            if ($info = $info->fetch_assoc()){
                if ($info['negative_attribute']) {
                    $output .= "<div class='negative-attribute'>";
                }
                else {
                    $output .= "<div>";
                }

                if ($innate && !str_contains($info['stat_value_display'], '-')) {
                    $output .= '+';
                }
                
                $output .= format_value($info['stat_value_display']);
                if (!str_contains($info['stat_value_display'], 'm')) {
                    $output .= $info['postfix'];
                }
                $output .= " {$info['label']}";
                $output .= "</div>";
            }
        }
    }
    return $output;
}



while($row = $data->fetch_assoc()){
    $properties = json_decode($row['properties']);
    $important_properties = json_decode($row['important_properties']);
    $elevated_properties = json_decode($row['elevated_properties']);
    
    if ($row['section_type'] === 'innate'){
        if($elevated_properties !== NULL && !empty($elevated_properties)) {
            $elevated_output = get_properties($elevated_properties, $db, $class_name, true);
            echo "<div class='properties'>{$elevated_output}</div>";
        }
        
        if($properties !== NULL && !empty($properties)) {
            $properties_output = get_properties($properties, $db, $class_name, true);
            echo "<div class='properties'>{$properties_output}</div>";
        }
    }
    else {
        /* select active or passive */
        $section_type = (($row['section_type'] === 'passive') || ($row['section_type'] === NULL) ? 'Passive' : 'Active');
        $header = "<div class='section-header'>{$section_type}</div>";


        
        /* display header and description with or w/o cooldown/chargeup */
        if ($properties !== NULL) {
            if ((in_array('AbilityCooldown', $properties) || in_array('AbilityChargeUpTime', $properties) || in_array('ProcCooldown', $properties))) {
                if (!empty($chargeup) && $chargeup['stat_value'] !== NULL && in_array('AbilityChargeUpTime',$properties)) {
                    $val = format_value($chargeup['stat_value']);
                    $header = "<div class='section-header'>{$section_type}<div><img src='./icons/charge.svg'>{$val}s</div></div>";
                }
                elseif (!empty($proc_cooldown) && $proc_cooldown['stat_value'] !== NULL && in_array('ProcCooldown',$properties)) {
                    $val = format_value($proc_cooldown['stat_value']);
                    $header = "<div class='section-header'>{$section_type}<div><img src='./icons/cooldown.svg'>{$val}s</div></div>";
                }
                elseif (!empty($cooldown) && $cooldown['stat_value'] !== NULL && in_array('AbilityCooldown',$properties)) {
                    $val = format_value($cooldown['stat_value']);
                    $header = "<div class='section-header'>{$section_type}<div><img src='./icons/cooldown.svg'>{$val}s</div></div>";
                }
            }
            /* OVERRIDES FOR ITEMS NOT INCLUDING COOLDOWN IN THE JSON */
            if (in_array($class_name_original, $overrides)) {
                if (!empty($cooldown) && $cooldown['stat_value'] !== NULL) {
                    $val = format_value($cooldown['stat_value']);
                    if ($val > 0) {
                        $header = "<div class='section-header'>{$section_type}<div><img src='./icons/cooldown.svg'>{$val}s</div></div>";
                    }
                }
            }
        }
        echo $header;
        echo "<div>{$row['loc_string']}</div>";
        



        
        /* display grid items. missing a closing </div> because it might accomodate flex-item-bottom */
        if ($row['important_properties'] !== NULL) {
            $important_output = get_main_grid($important_properties, $db, $class_name, $property_overrides);
            if (!empty($important_output)) {
                echo "<div class='flex-container'>{$important_output}";
            }
            
        }
        elseif (($row['elevated_properties'] !== NULL) && !empty($row['elevated_properties'])) {
            $elevated_output = get_main_grid($elevated_properties, $db, $class_name, $property_overrides);
            if (!empty($elevated_output)) {
                echo "<div class='flex-container'>{$elevated_output}";
            }
        }

        

        

        /* display extra properties items. extra </div> because it must be contained within flex-container */
        if($properties !== NULL && !empty($properties)) {
            /* echo 'hihihihi!'; */
            $properties_output = get_properties($properties, $db, $class_name, false);
            if (!empty($properties_output)) {
                /* echo 'hihihihi!'; */
                echo "<div class='flex-item-bottom'>{$properties_output}</div></div>";
            }
            else {
                echo "</div>";
            }
        }
        else {
            echo "</div>";
        }
        


    }
}