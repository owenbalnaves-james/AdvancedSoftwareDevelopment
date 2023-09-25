
<header>
  <link rel="stylesheet" href="menuManagement.css">

  <h1>Online Menu</h1>
  <?php
    session_cache_limiter('private_no_expire');
    session_start();
    
    include("connection.php");
    //include("functions.php");
  ?>
  
    <a href="index.html">Home</a>
</header>

<body>
<section>
<form action="searchMenu.php" method="POST" class="search-container">
	<input  class="c-posts" type="text" name="search_data" id="search_data" class="search-input"/>
    <input type="submit" value="Search" class="search-button"/>
    <br><br>
    <label for="searcyByLabel">Search by:</label>
    <select id="searchBy" name="searchBy" size="2" multiple>
        <option id="name" value="name">name</option>
        <option id="category" value="category">category</option>
    </select>
	
</form>
</section>

<?php 
  $_SESSION['doQuery'] = false;
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $search_data = $_POST['search_data'];
    $searchBy = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
    
    if ($searchBy == 'name') {
        $query = "select * from menuitems where name = '$search_data'";
        $result = mysqli_query($con,$query);
    }
    else   {
        $query = "select * from menuitems where category = '$search_data'";
        $result = mysqli_query($con,$query);
    }
    

    echo "<h1> RESULTS </h1> <br>";

    echo "<h3 class = ''>You searched for: " . $search_data . "</h3>";

    echo "<div class='results-table'";
    
    if($result)
    {
        if($result && mysqli_num_rows($result)> 0)
        {
          while($row = $result->fetch_assoc()) {
            echo "<div> <h4>" . "<img src=" . ($row["imageLink"]) ." width=300 height=300 style='margin-top: 00'> <br> <br> " . 
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
          echo "</div>";
        } 
        else {
          echo "<h4 class='subHeading'> No results found. </h4>";
        }
      }
    }

    echo "</div>";
    
    echo "<br><br><a href=listAllProducts.php class='c-btn' style='position:absolute; margin-left:20px;'>View Whole Menu</a>";

    function product_page() {
      header("location: menu.php");
      die;
    } 
?>

 <script>//page only updates after a reload so fore a reload once upon navigating to page

 
</script>
</body>
