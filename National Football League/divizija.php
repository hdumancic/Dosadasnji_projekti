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
        
        $upit = "SELECT naziv, broj_timova FROM divizija";
        
        $odgovor = @mysqli_query($db_connect, $upit);
        
        if($odgovor){
            
            echo '<table align="left"
            cellspacing="5" cellpadding="8">
            
            <tr><td align="left"><b>Naziv divizije</b></td>
            <td align="left"><b>Broj timova</b></td></tr>';
            
            while($red = mysqli_fetch_array($odgovor)){
                
                echo '<tr><td align= "left">' .
                $red['naziv'] . '</td><td align = "left">' .
                $red['broj_timova'] . '</td><td align = "left">';
                
                echo '</tr>';
            }
            
            echo '</table>';
            
        } else {
            
            echo "Upit bazi podataka nije poslan!";
            echo mysqli_error($db_connect);
        }
        
        mysqli_close($db_connect);
        
        
        ?>
    </body>
</html>
