<?php
    $server='localhost';
    $user='root';
    $password='';
    $db='library';

    $con=mysqli_connect($server,$user,$password,$db);

    if($con)
    {
      
    }
    else
    {
        ?>
        <script>
            alert("Connection Failed!");
        </script>
        <?php
    }

?>