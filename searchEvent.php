
<header>
  <h1>Your Events</h1>
  <?php
    //session_cache_limiter('private_no_expire');
    session_start();
    
    include("connection.php");
    //include("functions.php");
  ?>
  <link rel="stylesheet" href="menuManagement.css">
  <a href="homepage.html">Home</a>
</header>

<body>
  <?php
    $query = "select * from events";
    $result = mysqli_query($con,$query);

    echo "<div class='outer-results-table'>";
    echo "<div class='results-table'>";
   
    echo "<h1> RESULTS </h1> <br>";

    echo "<h2>You searched for: " . $search_data . "</h2>";
  
    if($result)
    {
        if($result && mysqli_num_rows($result)> 0)
        {
          while($row = $result->fetch_assoc()) {
            echo "<div> <h4> <b style='font-size: 25px;'> " 
            . $row["name"] . "</b> <br> <br>" .
             "  <em> Price $ </em>" . $row["price"] . "<br>" 
             .  "</h4>" . "<br> </div>";
          
              echo "<form action='menuItem.php' method='POST'> " ;
              echo "<input type='hidden' name='id' id='id' value='" . $row['id'] . "'/>
              <input type='hidden' name='name' id='name' value='" . $row['name'] . "'/>
              
              
              ";

              echo "</form>";
              $_SESSION['name'] = $row['name'];
              $_SESSION['category'] = $row['category'];
              $_SESSION['price'] = $row['price'];
              $_SESSION['imageLink'] = $row['imageLink'];
            
          }
        } 
        else {
          echo "<h4 class='subHeading'> No results found. </h4>";
        }
        echo "<br><br><form action='menuItem.php' method='POST'> 
        <input class='c-btn' type='submit' name='productBtn' value='Create Menu Item'/></form>";
      }
      echo "</div>";
      echo "</div>";
  
  
  
  ?>




</body>