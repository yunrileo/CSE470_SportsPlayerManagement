<?php
 $db = mysqli_connect('localhost', 'root', 'mysql@123') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'sports-database' ) or die(mysqli_error($db));
?>