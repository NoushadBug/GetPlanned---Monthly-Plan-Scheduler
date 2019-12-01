
<?php

        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $db = "getplanned";

////////// Connect to MySQL////////////////
        $conn = new mysqli($dbHost, $dbUser, $dbPass);
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }



////////// If database is not exist create one////////////////

        if (!mysqli_select_db($conn,$db))
        {
            $CreateDB = "CREATE DATABASE ".$db;
            $conn->query($CreateDB);
            mysqli_select_db($conn,$db);
        } 


        
//////// sql to create table if not exists in the database////////
        $CreateTable = "CREATE TABLE IF NOT EXISTS plans (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        date int(6) NOT NULL,
        month VARCHAR(30) NOT NULL,
        year int(10) NOT NULL,
        holiday tinyint(1) NOT NULL,
        priority tinyint(1) NOT NULL,
        name VARCHAR(50),
        description VARCHAR(225)
        )";
        $conn->query($CreateTable); //


        extract($_POST);


        if(isset($_POST['month']) && isset($_POST['month']) != "")
        {
                $response = array();
                $arr = array();
                $month = $_POST['month'];
                $year = $_POST['year'];
                // echo json_encode($year);

                $query = "SELECT date from plans WHERE month='$month' AND year='$year'";
                
                if (!$result =  $conn->query($query)) {
                        exit(error_log());
                    }
                    
                
                    if($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                        
                        $response = $row;
                        echo json_encode($response);
                            
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
                 
                }
                
                // IF THE SELECTED ID IS NOT AVAILABLE IN DATABASE IT WILL PRINT INVALID REQUEST
                else
                {
                    $response['status'] = 200;
                    $response['message'] = "Invalid Request!";
                }
                
        

?>