<?php

include 'connection.php';
extract($_POST);

$date = $_POST['dates'];
$month = $_POST['months'];
$year = $_POST['years'];

$sql = "SELECT id,name,description FROM plans WHERE date='$dates' AND month='$months' AND year='$years';";
$result = $conn->query($sql);
$counter = 0;

if ($result->num_rows > 0)
{
  echo '<h5 style="display: block;padding-left: 55px;margin-bottom: -65px;margin-left: 20px;background-color: darkslateblue;color: white;padding-top: 5px;padding-bottom: 5px;width: fit-content;padding-right: 20px;border-radius: 50px">Plan Lists</h5>';
  echo '<table class="table-responsive bordered highlight centered hoverable z-depth-2" v-show="persons.length">';
  // <-- Table head -->
  echo '<thead style="align-content: center; margin: auto;">';
  echo '<div style="box-shadow: 0.2px 3px 5px #303030;border-radius:10px;width: 65px;height: 50px;margin:0;background-image: linear-gradient( 185deg, #7eb22a 10%, rgb(170, 212, 18) 100%);"><a href="./index.php"title=\'home page\'><h3 style="text-align:center;color:white;"><i class="material-icons">home</i></h3></a></div>';
  echo "<tr style='background-color:#7eb22a;color:white;font-size:20px;'>";
  echo '<th>No.</th>';
  echo '<th colspan="2">Name</th>';
  echo '<th colspan="3">Description</th>';
  echo '<th colspan="2">Actions</th>';
  echo '</tr>';
  echo '</thead>';

  // <-- Table body -->
  echo '<tbody>';

  while($row = $result->fetch_assoc())
  {
    $counter++;
    echo "<tr>";
    echo "<td>".$counter."</td>";
    echo '<td colspan="2">'.$row["name"].'</td>';
    echo '<td colspan="3">'.$row["description"].'</td>';
    echo '<td style="width: 18%;">
    <a href="#updating" onclick = "GetPlanDetails('.$row['id'].')"  class="btn waves-effect waves-light purple darken-4 modal-trigger"><i class="material-icons">edit</i>
    </a>
    <a href="#!" onclick = "DeleteUser('.$row['id'].')" class="btn waves-effect waves-light #b71c1c red darken-4" @click="archive(index)"><i class="material-icons">delete</i>
    </a>
    </td>';
    echo '</tr>';
  }
  echo "</tbody>";
  echo "</table>";
}

else
{
  echo '<div style="box-shadow: 0.2px 3px 5px #303030;border-radius:10px;width: 75px;height: 50px;margin:auto;background-image: linear-gradient( 185deg, #7eb22a 10%, rgb(170, 212, 18) 100%);"><a href="./index.php"title=\'home page\'><h3 style="text-align:center;color:white;"><i class="material-icons"style="text-align:center">home</i></h3></a></div>';
  echo '<h5 style="margin:64px 0 12px auto;text-align:center;">0 RESULTS</h5>';
}
echo '<div class="adder"style="display:block;box-shadow: 0.2px 3px 5px #303030;border-radius: 50%;width: 50px;height: 50px;margin:auto;background-color:#7eb22a;">
<a href="./addplan.html"title=\'add new plan\'><h3 style="text-align:center;color:white;">+</h3></a>  
</div>';


?>




 <!-- Modal Structure --> 

<div class="modal" id = "updating" style="max-height:100%;">

  <div class="modal-content" >
  <div class="modal-header">
  <button  class="btn-small waves-effect right modal-close btn-floating"><i class="material-icons prefix">close</i></button>
  <h4 class="">Update Plan</h4> 
</div>
  
    <div method="POST" id="updateForm" enctype="multipart/form-data">
      <!-- HOLIDAY CHECKBOX -->

      
      <div class="input-field" > 
      <input type="checkbox" name="Holiday" id="holiday" value="1">
      <label for="holiday">Holiday</label> 

    <br><br><br>
    <!-- <-- NAME INPUT-FIELD --> 
      <div class="input-field">
        <i class="material-icons prefix">textsms</i>
        <input type="text" name = "name" id="name" required>
        
      </div>
      <br><br>
       <!-- <-- PRIORITY RADIO BUTTON FIELD  -->
    <i class="material-icons prefix">low_priority</i>
      <div class="container" id="radio">
          Event Priority:
        <ul>

          <li>
            <input type="radio" id="f-option"  name="selector"  value="1" required> 
            <label for="f-option">High</label>
            
            <div class="check"><div class="inside"></div></div>
          </li>
          
          <li>
            <input type="radio" id="s-option" name="selector"  value="2" required>
            <label for="s-option">Medium</label>
            
            <div class="check"><div class="inside"></div></div>
          </li>

          <li>
            <input type="radio" id="t-option" name="selector"  value="3" required>
            <label for="t-option">Low</label>
            
            <div class="check"><div class="inside"></div></div>
          </li>

        </ul>         
      </div> 
    <br>

     <!-- <-- DESCRIPTION INPUT-FIELD -->
      <div class="input-field">
        <i class="material-icons prefix">description</i>
        <textarea name="description" id="description" placeholder="Description"required></textarea>
      </div>

    <br><br>

    <!-- MODAL FOOTER -->
      <div class="modal-footer">
      <!-- SUBMIT AND CLOSE BUTTONS -->
        
        <input type="hidden" id="hidden_plan_id" >
        <button type="submit" onclick = "UpdatePlan()" class="btn btn-large #00b0ff blue accent-3 modal-close" >save</button>
      
      </div>

    </div>
  </div>
</div>


<script >


//  MATERIALIZE MODAL SCRIPT //

$(document).ready(function()
{
    $('.modal').modal();
});


function GetPlanDetails(id)
{
        $("#hidden_plan_id").val(id);

        $.post("update.php", {
          id: id  
          },
    function (data, status) {
        //JSON.parse() parses a string, written in JSON format, and returns a JavaScript object.
        var plan = JSON.parse(data);
        
        $("#holiday").val(plan.holiday);
        $("#name").val(plan.name);
        $("#radio").val(plan.priority);
        $("#description").val(plan.description);
      }
  );
  $("#updating").modal("open");
}


 /////// FUNCTION FOR UPDATING RECORD ////////
 function UpdatePlan()
        {
          var holiday = $('#holiday').val();
          var description = $('#description').val();
          var priority = $('input[name=selector]:checked').val();
          var name = $('#name').val();         
          var hidden_plan_id = $('#hidden_plan_id').val();

          
          $.ajax({
            url:"update.php",
            type:'POST',
            
            data: { 
              hidden_plan_id : hidden_plan_id,
              name :name,
              holiday : holiday,
              description : description,
              priority : priority
            },
            
            
  
            success:function(data,status){
              readRecords();
            }


          });
        }	

        function readRecords()
        {
          var readrecord = "readrecord";
          $.ajax({
            url:"#",
            type:"POST",
            data:{ readrecord:readrecord,
                   date:date,
                   month:month,
                   year:year
            },
            success:function(data,status){
                $('#reload').html(data);
            }
          })
          
        }

</script>


