<header class="c-header">
  <h1>Editing Menu</h1>
  <p></p>
  
</header>
<div class="background">
<section class="c-posts">
<div class="new1">
  <article class="c-posts__item">
  </article>
</div>
</section>
<?php
  include("connection.php");
  include("functions.php");
  
  session_cache_limiter('private_no_expire');

  session_start();
  
  if (!isset($_POST['id'])) {
    $name = "";
    $category = "";
    $price = 0;
    $pickupOnly = "false";
    $link = "";
    $pID = 24;

    $value = "create";

    $submitValue = "Save Changes";
    $formHeader = "Create New Dish: ";
  }
  else {
    $pID = $_POST['id'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {    
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $pickupOnly = $_POST['pickupOnly'];
        $link = $_POST["imageLink"]; 

        $value = "edit";

        $submitValue = "Save Changes";
        $formHeader = "Edit Menu: ";
    }
  }

  
?>

<link rel="stylesheet" href="menuManagement.css">

<div class="main-content" style="text-align:center; padding:20px;">
      <div id="box">
        <form method="POST" action='searchMenu.php'>
        <div class="btn-block">
        <a href="searchMenu.php" style="color:gray; top:180px; left: 18px; position:absolute;">Back<br><br></a>
      </div>
        <div class=""><h3><?php echo "$formHeader" . $name;?></h3><br><br></div>
        <label id="icon" for="name"><i class="input"> Name:  </i></label>
        <input type="text" name="name" id="name" value="<?php echo $name;?>" required/>

        <label id="icon" for="name"><i class="input">Category: </i></label>
        <input style="height:100px;" type="text" name="category" id="category" value="<?php echo $category;?>" required/>

        <label id="icon" for="name"><i class="input">Price:  </i></label>
        <input type="number" name="price" id="price" value="<?php echo $price;?>" required/>

        <label id="icon" for="name"><i class="input">Pickup Only?  </i></label>
        <input type="number" name="pickupOnly" id="pickupOnly" value="<?php echo $pickupOnly;?>" required/>

        <label id="icon" for="name"><i class="input">Link to product image:  </i></label>
        <input type="text" name="imageLink" id="imageLink" value="<?php echo $link;?>" required/>

        <input type='hidden' name='id' id='id' value="<?php echo $pID;?>"/>

        <input type='hidden' name='task' id='task' value="<?php echo $value;?>"/>
        <br><br><br>
      </div class='input'>
        <div >
          <input class="c-btn"id="button" type="submit" value="<?php echo "$submitValue"; ?>"><br><br>
        </div>
      </form>
    </div>

    <div class="main-block" style="text-align:center; padding:20px;">
      <div id="box">
        <form method="post" action='productDeleted.php'>
        <input type='hidden' name='productID' id='productID' value="<?php echo "$pID";?>"/>
        <input class="c-btn"id="button" type="submit" value="Delete product"><br><br>
        </div>
      </form>
    </div>
    <br><br><br><br><br>
