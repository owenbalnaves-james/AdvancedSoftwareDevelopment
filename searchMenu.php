
<header>
  <h1>Online Menu</h1>
  <?php
    session_cache_limiter('private_no_expire');
    session_start();
    
    include("connection.php");
    //include("functions.php");
  ?>
  <link rel="stylesheet" href="menuManagement.css">
  <a href="homepage.html">Home</a>
</header>

<body>
<section>
<form action="searchMenu.php" method="POST" class="search-container">
	  <input class="search-input"  type="text" name="search_data" id="search_data" />
    <input class="search-button" type="submit" value="Search" />
    <br><br>
</form>
</section>

<?php 
  $_SESSION['doQuery'] = false;
  if($_SERVER['REQUEST_METHOD'] == "POST" || isset($_GET['link']))
  {
    if (isset($_POST['search_data']) && $_POST['search_data'] != null) {
      $search_data = $_POST['search_data'];

      $query = "select * from menuitems where name = '$search_data'";
      $result = mysqli_query($con,$query);
    }
    else if ($_GET['link'] != null) {
      
      $l = $_GET['link'];
      if ($l == '1'){
        $query = "select * from menuitems where category = 'Entrees'";
        $search_data = "Entrees";
      }else if ($l == '2'){
        $query = "select * from menuitems where category = 'Pizzas'";
        $search_data = "Pizzas";
      }else if ($l == '3') {
        $query = "select * from menuitems where category = 'Pastas'";
        $search_data = "Pastas";
      }
      else {
        $query = "select * from menuitems where category = 'hhh'";
        $search_data = "hhh";
      }

      $result = mysqli_query($con,$query);
    }

    echo "<div class='outer-results-table'>";
    echo "<div class='results-table'>";
   
    echo "<h1> RESULTS </h1> <br>";

    echo "<h2>You searched for: " . $search_data . "</h2>";
  
    if($result)
    {
        if($result && mysqli_num_rows($result)> 0)
        {
          while($row = $result->fetch_assoc()) {
            echo "<div> <h4>" . "<img src=" . ($row["imageLink"]) ." width=98% height=49% > <br> <br> " . 
             " <b style='font-size: 25px;'> " . $row["name"] . "</b> <br> <br>" .
             "  <em> Price $ </em>" . $row["price"] . "<br>" 
             .  "</h4>" . "<br> </div>";

            if (true) {//If user is not an employee, show produt profile page
              echo "<form action='menu.php' method='POST'> 
              <input class='c-btn' type='submit' name='productBtn' value='Go to Product Page'/>";
              echo "<input type='hidden' name='searchID' value='" . $row['id'] . "'/>";          
              echo "</form>";
            }
            else {//If user is an employee, show create product page + link to page to edit product
              echo "<form action='productEdit.php' method='post'> " ;
              echo "<input type='hidden' name='productID' id='productID' value='" . $row['id'] . "'/>
              <input type='hidden' name='product_name' id='product_name' value='" . $row['name'] . "'/>
              <input type='hidden' name='product_desc' id='product_desc' value='" . $row['category'] . "'/>
              <input type='hidden' name='price' id='price' value='" . $row['price'] . "'/>
              <input type='hidden' name='imageLink' id='imageLink' value='" . $row['imageLink'] . "'/>
              <input class='c-btn' type='submit' name='productBtn' value='Edit Menu Item'/>";
              echo "</form>";
              $_SESSION['name'] = $row['name'];
              $_SESSION['category'] = $row['category'];
              $_SESSION['price'] = $row['price'];
              $_SESSION['imageLink'] = $row['imageLink'];
            }
          }
          //echo "</div>";
        } 
        else {
          echo "<h4 class='subHeading'> No results found. </h4>";
        }
      }
      echo "</div>";
      echo "</div>";
    }
    else {
      echo "<div class='outer-results-table'>";
      echo "<div class='results-table'>";
      echo "<br><br><br><br><br>";
      echo "<h3> Delicious Italian Pizzas, Pastas, Salads and Desserts with special dietary options. </h3>";
      echo "<br><br><br><br><br>";
      echo "</div>";
      echo "</div>";
    }

    
    
    function product_page() {
      header("location: menu.php");
      die;
    } 
  ?>

    <div class="menu-categories"> 
      <h1>Select By Category:</h1>
      <div class="menu-categories-inner">
        <ul class="menu-categories-list">
          <li><a href="searchMenu.php?link=1" name="link1">Entrees</a></li>
          <li><a href="searchMenu.php?link=2">Pizzas</a></li>
          <li><a href="searchMenu.php?link=3">Pastas</a></li>
        </ul>
        <?php echo "<br><br><a href=listAllProducts.php class='c-btn' style='margin-left:20px; margin-bottom:10px;'>View Whole Menu</a>"; ?>
      </div>
    </div>
</body>
