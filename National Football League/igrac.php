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
        
        // mijenjanje boje pozadine
        //echo '<body style="background-color:orange">';
        //header("Content-Type: image/png");
        
        require_once('../konekcija.php');
        
        $upit = "SELECT igrac_id, ime, prezime, godina, visina, tezina, mjesto_rodenja, tim_id FROM igrac";
        
        $odgovor = @mysqli_query($db_connect, $upit);
        
        if($odgovor){
            
            echo '<table align="left|center"
            cellspacing="5" cellpadding="8">
            
            <tr><td align="left"><b>ID igraca</b></td>
            <td align="left"><b>Ime</b></td>
            <td align="left"><b>Prezime</b></td>
            <td align="left"><b>Godina</b></td>
            <td align="left"><b>Visina</b></td>
            <td align="left"><b>Tezina</b></td>
            <td align="left"><b>Mjesto rodenja</b></td>
            <td align="left"><b>Tim ID</b></td></tr>';
            
            while($red = mysqli_fetch_array($odgovor)){
                
                echo '<tr><td align= "left">' .
                $red['igrac_id'] . '</td><td align = "left">' .
                $red['ime'] . '</td><td align = "left">' .
                $red['prezime'] . '</td><td align = "left">' .
                $red['godina'] . '</td><td align = "left">' .
                $red['visina'] . '</td><td align = "left">' .
                $red['tezina'] . '</td><td align = "left">' .
                $red['mjesto_rodenja'] . '</td><td align = "left">' .
                $red['tim_id'] . '</td><td align = "left">';
                
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
