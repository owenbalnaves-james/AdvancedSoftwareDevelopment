<header class="c-header">
  <h1>Product search</h1>
  <?php
    session_cache_limiter('private_no_expire');
    session_start();
  ?>
  <p></p>
  <?php
    include("connection.php");
    //include("functions.php");
  ?>
  <ul class="navbar">
    <li><a href="index.html">Home</a></li>
    <?php

    
    ?>
  </ul>
  
</header>
<section class="c-posts">
<div> 
<form action="menu.php" method="POST">
	<input  type="text" name="search_data" id="searchValue" style="margin-left:-100px; width: 140%; height: 100%; display:block;"/>
	<input type="submit" value="Search" style="float:right; width: 80%; height: 100%; margin-top:-36;"/>
</form>
</div>
<div>
</div>
</section>

<?php 
  $_SESSION['doQuery'] = false;
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $search_data = $_POST['search_data'];
    
    $query = "select * from menuitems where name = '$search_data'";
    $result = mysqli_query($con,$query);

    echo "<h1 style='text-align:left; margin-top:-40; margin-left: 200;'> RESULTS </h1> <br>";

    echo "<h3 style = 'margin-left: 200;'>You searched for: " . $search_data . "</h3>";
    
    if($result)
    {
        if($result && mysqli_num_rows($result)> 0)
        {
          while($row = $result->fetch_assoc()) {
            echo "<div> <h4>" . "<img src=" . ($row["imageLink"]) ." width=300 height=300 style='margin-top: 00'> <br> <br> " . 
             " <b style='font-size: 25px;'> " . $row["name"] . "</b> <br> <br>" .
             "  <em> Price $ </em>" . $row["price"] . "<br>" 
            .  "</h4>" . "<br> </div>";

            if (false) {//If user is not an employee, show produt profile page
              echo "<form action='menu.php' method='post'> 
              <input class='c-btn' type='submit' name='productBtn' value='Go to Product Page'/>";
              echo "<input type='hidden' name='productID' value='" . $row['id'] . "'/>";          
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
          echo "<h4> No results found. </h4>";
        }
      }
    }
    
    echo "<br><br><a href=listAllProducts.php class='c-btn' style='position:absolute; margin-left:200px;'>View All Products</a>";

    function product_page() {
      header("location: menu.php");
      die;
    } 
?>

 <script>//page only updates after a reload so fore a reload once upon navigating to page

  window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         (typeof window.performance == "undefined" ||
                              window.performance.navigation.type == 2);
  if ( historyTraversal) {
    // Handle page restore.
    window.location.reload();
  }
  });
  if ( document.referrer != 'http://localhost/dashboard/menuSearch.php') {
    window.location.reload();
  }
</script>

<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank" >UTSAlumni.com</a></p>
</footer>