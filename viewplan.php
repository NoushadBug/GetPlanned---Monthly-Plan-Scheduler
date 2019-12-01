<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./img/vector_827_11-512.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/viewplan.css"> 
    <link rel="stylesheet" type="text/css" href="./css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>GetPlanned - View Plans</title>
</head>
<body>
    
<div id="app">

  <!-- INCLUDING JQUERY SCRIPT LOCALLY -->
      <script  src="./js/jquery-3.4.1.min.js"></script> 

  <!-- INCLUDING MATERIALIZE SCRIPT LOCALLY -->
      <script  src="./js/materialize.min.js"></script>


      <h4 id="head"></h4>


      <script type="text/javascript">

        $(document).ready(function(){

          readRecords();
          
        });

        //////// STORING SELECTED DATE MONTH AND YEAR FROM LOCAL STORAGE ////////

        var head = document.getElementById('head');
        head.innerHTML = localStorage.getItem('date')+" "+localStorage.getItem('month')+", "+localStorage.getItem('year')+"<br>"+localStorage.getItem('day');

        var date = localStorage.getItem('date');
        var month = localStorage.getItem('month');
        var year = localStorage.getItem('year');
        
        //////// STORING SELECTED DATE MONTH AND YEAR FROM LOCAL STORAGE ////////
        

          function readRecords()
          {
            var readrecord = "readrecord";
            $.ajax({
              url:"./readData.php",
              type:"POST",
              data:{ readrecord:readrecord,
                    dates:date,
                    months:month,
                    years:year
              },
              success:function(data,status){
                  $('#reload').html(data);
              }
            })
            
          }

          /////////////delete userdetails ////////////
          function DeleteUser(deleteid){

          var conf = confirm("Are You Sure You Want to Delete This Plan?");
          if(conf == true) 
          {
            $.ajax({
              url:"delete.php",
              type:'POST',
              data: {  deleteid : deleteid},

              success:function(data, status){
                readRecords();
              }
            });
          }
          }

      </script>



      <div class="container" id = "reload">
             

      </div>
    </div>
  </body>
</html>
