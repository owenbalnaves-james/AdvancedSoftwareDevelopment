    <?php
        function get_user_data($con)
        {
            if(isset($_SESSION['user_id']))
            {
                $id = $_SESSION['user_id'];
                $quary = "select * from users where id = '$id' limit 1";

                $result = mysqli_query($con,$quary);
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    return $user_data;
                }
            }
        }
    ?>