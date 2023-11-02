
<header>
  <h1>Events Page</h1>
  <?php
    include("connection.php");
    //session_cache_limiter('private_no_expire');
    session_start();
    
    
  ?>
  <link rel="stylesheet" href="menuManagement.css">
  <a href="homepage.html">Home</a>
</header>

<body>
  <?php
    if (isset($_POST["customerID"])) {
      $query = "select * from events where organiserID  = '$id' order by status" ;
      $result = mysqli_query($con,$query);
    }
    else {
      $query = "select * from events where NOT status = 'rejected'";
      $result = mysqli_query($con,$query);
    }
    
    if (isset($_POST['task'])) {
      $value = $_POST['task'];
      $eventID = $_POST['eventID'];
  
      if ($value == 'edit' || $value == 'create') {
        if (!isset($_POST["pID"])) {//If customer not employee
          $eventName = $_POST['name'];
          $numAtendees = $_POST['numAtendees'];
          $eventDate = $_POST['date'];
          $eventDescription = $_POST['description'];
          
          //Get specialrequest data
          $veganOptions = $_POST['$veganOptions'];
          $specialCake = $_POST['$specialCake'];
          $tableSize = $_POST['$tableSize'];
          $tablesOutside = $_POST['$tablesOutside'];
          $kidsTable = $_POST['$kidsTable'];
          $largePizzas = $_POST['$largePizzas'];
          $song = $_POST['$song'];
        }
        else {
          $iName = $_POST['name'];
          $iStatus = $_POST['status'];
        }
        
        if ($value == 'edit') {
          if (!isset($_POST["customerID"])) {
            $specialReqID = $_POST['specialRequestsID'];
            $eventID = $_POST['eventID'];
            $query = "update events set name='$eventName', numAtendees='$numAtendees', date='$eventDate', description='$eventDescription' where eventID = '$eventID';";
            mysqli_query($con,$query);
            $query1 = "select specialRequestsID from events where eventID='$eventID';";
            $result = mysqli_query($con,$query1);
            //$query2 = "update specialRequests set veganOptions='$eventName', specialCake='$numAtendees', largeTable='$eventDate', tablesOutside='$eventDescription', kidsMeals='', exLargePizzas='', playSong='' where id = '$result';";
            //mysqli_query($con,$query2); 
            echo "<h3>Event edited.</h3>";
            $value = "None";
            header("Refresh:0");
          }
          else {
            if ($iStatus == "approved") {
              echo "<h3>Event has already been approved.</h3>";
            }
            else {
              $query = "update events set status='$iStatus' where eventID = '$eventID';";
              mysqli_query($con,$query);
              echo "<h3>Event " . $iName . " has been approved. </h3>";
            }
          }
          //$value = "None";
          //header("Refresh:0");
        }
        else if ($value == 'create') {
          $organiserID = $_POST['$organiserID'];
          $query = "insert into events (name,numAtendees,date,description,specialRequestsID) values ('$eventName','$numAtendees','$eventDate','$eventDescription', 'select specialRequestsID from events where name='$eventName'')";
          mysqli_query($con,$query);
          $query2 = "insert into specialRequests (veganOptions,specialCake,largeTable,tablesOutside,kidsMeals,exLargePizzas,playSong) values ('$veganOptions', '$specialCake', '$tableSize', '$tablesOutside', '$kidsTable', '$largePizzas', '$song')";          

          
          mysqli_query($con,$query2);

          //$query3 = "update specialRequests set specialRequestsID = 'select specialRequestsID from events where name='$eventName'";
         // mysqli_query($con,$query3);

          echo "<h3>New event added.</h3>";
          //$value = "None";
          //header("Refresh:0");
        }
      }
      else if ($value == 'delete') {
        $query1 = "delete from events where eventID='$eventID';";
        //$query2 = "delete from specialRequests where specialRequestsID='select specialRequestsID from events where eventID='$eventID'';";//Deleting special requests item 
        //mysqli_query($con,$query2);
        mysqli_query($con,$query1);

        echo "<h3>Event deleted.</h3>";
        $value = "None";
        header("Refresh:0");
      }
    }

    echo "<br><br><br>";
    echo "<div class='outer-results-table'>";
    echo "<div class='results-table'>";
   
    echo "<h1> ALL EVENTS </h1> <br>";
  
    if($result)
    {
        if($result && mysqli_num_rows($result) > 0)
        {
          while($row = $result->fetch_assoc()) {//Editing an event 
             echo "<div> <h4> <b style='font-size: 25px;'> " 
             . $row["name"] . "</b> <br> <br>" .
             "  <em> Number of atendees: </em>" . $row["numAtendees"] . "<br><br>" 
             . $row["date"] .  "<br><br>" . $row["description"] . "<br><br>" . $row["status"] . "</h4>" . "<br> </div>";
          
              echo "<form action='eventItem.php' method='POST'>";
              echo "<input type='hidden' name='eventID' id='eventID' value='" . $row['eventID'] . "'/>
              <input type='hidden' name='name' id='name' value='" . $row['name'] . "'/>
              <input type='hidden' name='organiserID' id='organiserID' value='" . $row['organiserID'] . "'/>
              <input type='hidden' name='numAtendees' id='numAtendees' value='" . $row['numAtendees'] . "'/>
              <input type='hidden' name='date' id='date' value='" . $row['date'] . "'/>
              <input type='hidden' name='description' id='description' value='" . $row['description'] . "'/>
              <input type='hidden' name='specialRequestsID' id='specialRequestsID' value='" . $row['specialRequestsID'] . "'/>
              <input type='hidden' name='status' id='status' value='" . $row['status'] . "'/>";

              if (!isset($_SESSION["employeeID"])) {
                echo "<input class='c-btn' type='submit' name='eventBtn' value='Edit Event'/>";
              }
              else if ($row['status'] == "submitted") {
                echo "<input type='hidden' name='employeeID' id='employeeID' value='" . $_POST['employeeID'] . "'/>";
                echo "<input class='c-btn' type='submit' name='eventBtn' value='Check event details'/>";
              }
              
              echo "</form>";   
          }
        } 
        else {
          echo "<h4 class='subHeading'> No events listed. </h4>";
        }
        if (!isset($_SESSION["employeeID"])) { 
          $abc = 444;
          echo "<br><br><form action='eventItem.php' method='POST'> 
          <input type='hidden' name='organiserID' id='organiserID' value='" . $abc . "'/>
          <input class='c-btn' type='submit' name='eventBtn' value='Create Event'/>
          </form>";
        }
        
      }
      echo "</div>";
      echo "</div>";
  
  ?>




</body>