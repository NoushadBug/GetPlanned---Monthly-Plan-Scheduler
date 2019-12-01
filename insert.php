
<?php 

    
///////////FORM INPUTS ARE STORING IN VARIABLES////////////////
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

$hiddenInfo = $_POST["extra"];
   

////////// DIVIDING THE YEAR FROM HIDDENINFO VARIABLE////////
    $lastindex = (strlen($hiddenInfo)-1);
    $year = (int)(substr($hiddenInfo, $lastindex-4, $lastindex));
    //

////////// DIVIDING THE DATE FROM HIDDENINFO VARIABLE////////

    for ($x = 0; $x < strlen($hiddenInfo); $x++)
    {
        if ($hiddenInfo[$x] == " ")
        {
            break;
        }

        $dateStr[$x] = $hiddenInfo[$x];
    }
    $date = (int)implode($dateStr);
    //

////////// DIVIDING THE MONTH FROM HIDDENINFO VARIABLE////////////////
    $x++;
    for ($x = $x; $x <= $lastindex-6; $x++) 
    {
        $month[$x] = $hiddenInfo[$x];
    }
    
    //

////////INCLUDING CONNECTION.PHP TO CONNECT WITH LOCAL SERVER////////
    include './add_new_row.php';
    

////////INSTRUCTIONS FOR INSERTING DATA TO DATABASE////////           
    $sql = "INSERT INTO plans (date, month, year, holiday, priority, name, description)
    VALUES ('$date','$month','$year','$holiday', '$priority', '$name', '$description')";
    if ($conn->query($sql))
    {
        echo "<link rel='stylesheet' type='text/css' href='./css/phpStyle.css'/>New record inserted sucessfully.<a href='./index.php' title='Go to main page'>done</a>";
    }
    else
    {
        echo "Error: ". $sql ."
        ". $conn->error;
    }
    $conn->close();
 
?>