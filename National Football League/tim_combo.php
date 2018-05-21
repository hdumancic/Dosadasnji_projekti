<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        require_once('../konekcija.php');
        
        $upit2 = mysqli_query($db_connect, "SELECT ime_tima from tim");
        echo "<select name='tim_id'>";
        while($row = mysqli_fetch_assoc($upit2))
        {
            echo "<option value = '".$row[ime_tima]."'>".$row[ime_tima]."</option>";
        }
        echo "</select";
        ?>
    </body>
</html>
