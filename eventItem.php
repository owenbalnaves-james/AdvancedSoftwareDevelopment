<header class="c-header">
  <h1>Event Management Menu</h1>
  <p></p>
</header>
<body>
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

  if (isset($_POST['id'])) {
    $name = "";
    $numAtendees = "";
    $date = 0;
    $description = "";
    $eventID = $_POST['ID'];
    $organiserID = $_POST['customerID'];

    $value = "edit";

    $submitValue = "Save Changes";
    $formHeader = "Create New Dish: ";
  }
  else {

  }


?>







</body>