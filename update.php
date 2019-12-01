


<?php

include './connection.php';
extract($_POST);
 
$response = array();

if(isset($_POST['readrecord'])){

    include './readData.php';	
}


if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    $user_id = $_POST['id'];
    $query = "SELECT * FROM plans WHERE id = '$user_id'";
    if (!$result =  $conn->query($query)) {
        exit(error_log());
    }
    

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
       
            $response = $row;
        }
    }
  //  WILL PRINT 'DATA NOT FOUND' IF THERE IS NO ROW IN THE DATABASE WITH THE SELECTED ID
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
   //     PHP has some built-in functions to handle JSON.
// Objects in PHP can be converted into JSON by using the PHP function json_encode(): 

    echo json_encode($response);
}

// IF THE SELECTED ID IS NOT AVAILABLE IN DATABASE IT WILL PRINT INVALID REQUEST
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}



///update table
if(isset($_POST['hidden_plan_id'])){  
      
    $hidden_plan_id = $_POST['hidden_plan_id'];
	$holiday = $_POST['holiday'];
	$priority = $_POST['priority'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $upquery = "UPDATE plans SET name='$name',priority='$priority',description='$description' WHERE id='$hidden_plan_id'";
    if (!$result = $conn->query($upquery)) {
        exit(error_log());
    }
}


?>