<?php

function add_img ($dbc, $property_id, $photos){

    if (is_array($photos) && count($photos) > 0) {
        foreach ($photos as $photo) {
            $q = "INSERT INTO property_image (property_id, img_dir) VALUES ($property_id, '$photo')";
            $r = mysqli_query($dbc, $q);
        }
        return 1;
    }else{
        return 0;
    }
}

?>