
<header>
  <h1>Events Page</h1>
  <?php
    //session_cache_limiter('private_no_expire');
    session_start();
    
    include("connection.php");
  ?>
  <link rel="stylesheet" href="menuManagement.css">
  <a href="homepage.html">Home</a>
</header>

<body>
  <?php
    if (isset($_POST["customerID"])) {
      $query = "select * from events where organiserID  = '$id'" ;
      $result = mysqli_query($con,$query);
    }
    else {
      $query = "select * from events";
      $result = mysqli_query($con,$query);
    }
    
    if (isset($_POST['task'])) {
      $value = $_POST['task'];
      $eventID = $_POST['eventID'];
  
      if ($value == 'edit' || $value == 'create') {

        if (isset($_POST["customerID"])) {
          $eventName = $_POST['name'];
          $numAtendees = $_POST['numAtendees'];
          $eventDate = $_POST['date'];
          $eventDescription = $_POST['description'];
          $specialReqID = $_POST['specialRequestsID'];
        }
        else {
          $iName = $_POST['name'];
          $iApproved = $_POST['approved'];
        }
        
        if ($value == 'edit') {
          if (isset($_POST["customerID"])) {
            $query = "update events set name='$eventName', category='$numAtendees', price='$eventDate', pickupOnly='$eventDescription' where id = $eventID;";
            mysqli_query($con,$query);
            echo "<h3>Event edited.</h3>";
          }
          else {
            if ($iApproved == true) {
              echo "<h3>Event has already been approved.</h3>";
            }
            else {
              echo "<h3>Event" . $iName . "has been approved. </h3>";
            }
          }
        }
        else if ($value == 'create') {
          $eventid = 34;
          $organiserID = $_POST['$organiserID'];
          $specialRequestsID = $_POST['$specialRequestsID'];
          $query = "insert into events (eventID,organiserID,name,numAtendees,date,description,specialRequestsID) values ('$eventID','$organiserID','$eventName','$numAtendees','$eventDate','$eventDescription','$specialRequestsID')";
          mysqli_query($con,$query);
          echo "<h3>New event added.</h3>";
        }
      }
      else if ($value == 'delete') {
        $query = "delete from events where eventID='$eventID';";
        mysqli_query($con,$query);
        echo "<h3>Event deleted.</h3>";
      }
    }

    echo "<br><br><br>";
    echo "<div class='outer-results-table'>";
    echo "<div class='results-table'>";
   
    echo "<h1> ALL EVENTS </h1> <br>";
  
    if($result)
    {
        if($result && mysqli_num_rows($result)> 0)
        {
          while($row = $result->fetch_assoc()) {//Editing an event 
            echo "<div> <h4> <b style='font-size: 25px;'> " 
            . $row["name"] . "</b> <br> <br>" .
             "  <em> Number of atendees: </em>" . $row["numAtendees"] . "<br><br>" 
             . $row["date"] .  "<br><br>" . $row["description"] . "<br><br>" . $row["approved"] . "</h4>" . "<br> </div>";
          
              echo "<form action='eventItem.php' method='POST'> " ;
              echo "<input type='hidden' name='name' id='name' value='" . $row['name'] . "'/>
              <input type='hidden' name='customerID' id='customerID' value='" . $row['customerID'] . "'/>
              <input type='hidden' name='numAtendees' id='numAtendees' value='" . $row['numAtendees'] . "'/>
              <input type='hidden' name='date' id='date' value='" . $row['date'] . "'/>
              <input type='hidden' name='date' id='date' value='" . $row['date'] . "'/>
              <input type='hidden' name='description' id='description' value='" . $row['description'] . "'/>
              <input type='hidden' name='specialRequestsID' id='specialRequestsID' value='" . $row['specialRequestsID'] . "'/>
              <input class='c-btn' type='submit' name='eventBtn' value='Edit Event'/>
              ";//Consider editing submitted events 

              echo "</form>";
              $_SESSION['eventID'] = $row['eventID'];
              $_SESSION['organiserID'] = $row['organiserID'];
              $_SESSION['numAtendees'] = $row['numAtendees'];
              $_SESSION['date'] = $row['date'];
              $_SESSION['description'] = $row['description'];
              $_SESSION['specialRequestsID'] = $row['specialRequestsID'];
              $_SESSION['approved'] = $row['approved'];
          }
        } 
        else {
          echo "<h4 class='subHeading'> No events listed. </h4>";
        }
        echo "<br><br><form action='eventItem.php' method='POST'> 
        <input class='c-btn' type='submit' name='productBtn' value='Create Event'/></form>";
      }
      echo "</div>";
      echo "</div>";
  
  ?>




</body>