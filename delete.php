<?php

include './connection.php';


if(isset($_POST['readrecord'])){

    include './readData.php';
	
}


/////////////Delete user record /////////

if(isset($_POST['deleteid']))
{

	$user_id = $_POST['deleteid']; 

	$deletequery = " DELETE FROM plans WHERE id ='$user_id' ";
	if (!$result =  $conn->query($deletequery)) {
        exit(error_log());

}
    
}


?>