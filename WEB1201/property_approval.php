<?php

function send_approval ($dbc, $property_id, $assessment_date){

    $q = "INSERT INTO property_approval(property_id, assessment_date) VALUES($property_id, '$assessment_date')";
    $r = mysqli_query($dbc, $q);

    if($r){
        return 1;
    }
    else{
        return 0;
    }

}

function give_approval ($dbc, $admin_id, $property_id) {

    $current_date = getdate();
    $input_date = date('Y-m-d H:i:s');

    $q = "UPDATE property_approval SET admin_id = $admin_id, approval_date = '$input_date' WHERE property_id = $property_id";
    $r = mysqli_query($dbc, $q);

    if($r){
        return 1;
    }
    else {
        return ;
    }
}

?>