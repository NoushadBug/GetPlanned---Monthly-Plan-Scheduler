
<?php 
    
    $hiddenInfo = $_POST["extra"];

    // DIVIDING THE YEAR FROM HIDDENINFO VARIABLE
    $lastindex = (strlen($hiddenInfo)-1);
    $year = (int)(substr($hiddenInfo, $lastindex-4, $lastindex));
    //

    // DIVIDING THE DATE FROM HIDDENINFO VARIABLE
    for ($x = 0; $x <= 3; $x++) 
    {
        if ($hiddenInfo[$x] == " ")
        {
            break;
        }

        $dateStr[$x] = $hiddenInfo[$x];
    }
    $date = (int)implode($dateStr);
    //

    // DIVIDING THE MONTH FROM HIDDENINFO VARIABLE
    $x++;
    for ($x; $x <= $lastindex-6; $x++) 
    {
        $month[$x] = $hiddenInfo[$x];
    }
    $month = implode($month);
    //

    //FORM INPUTS ARE STORING IN VARIABLES
    $holiday = filter_input(INPUT_POST, 'holiday');
    if (isset($holiday)) 
    {
        $holiday = 1;
    }

    else 
    {
        $holiday = 0;
    }
    
    $priority = filter_input(INPUT_POST, 'selector');
    $name = filter_input(INPUT_POST, 'name');
    $description = filter_input(INPUT_POST, 'description'); //



    
    if (!empty($holiday) ||!empty($date) ||!empty($month) ||!empty($year) || !empty($priority) || !empty($name) || !empty($description))
    {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $db = "getplanned";

        // Connect to MySQL
        $conn = new mysqli($dbHost, $dbUser, $dbPass);
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        // If database is not exist create one
        if (!mysqli_select_db($conn,$db))
        {
            $CreateDB = "CREATE DATABASE ".$db;
            $conn->query($CreateDB);
            mysqli_select_db($conn,$db);
        } 


        
        // sql to create table if not exists in the database
        $CreateTable = "CREATE TABLE IF NOT EXISTS plans (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        date int(6) NOT NULL,
        month VARCHAR(30) NOT NULL,
        year int(10) NOT NULL,
        holiday tinyint(1),
        priority VARCHAR(30),
        name VARCHAR(50),
        description VARCHAR(225)
        )";
        $conn->query($CreateTable); //

    }
    else
    {
        echo " FILL UP ALL VALUE! ";
        die();
    }

?>