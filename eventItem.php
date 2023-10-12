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

  if (!isset($_POST['id'])) {//event ID
    $name = "";
    $numAtendees = "";
    $date = 0;
    $description = "";
    $organiserID = $_POST['customerID'];

    $value = "create";

    $submitValue = "Save Changes";
    $formHeader = "Create Event: ";
  }
  else {
    $name = $_POST['name'];
    $numAtendees = $_POST['numAtendees'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $organiserID = $_POST['customerID'];

    $value = "edit";

    $submitValue = "Save Changes";
    $formHeader = "Edit event: ";
  }

?>







</body>