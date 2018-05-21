<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodaj novog igraca</title>
    </head>
    <body>

        <form action="http://localhost/Baze2_Projekt/NoviIgrac.php" method="post">
                       
            <b>Dodaj novog igraca </b>
               
            
            <p>Ime:
        <input type="text" name="ime" size="30" value="" />
        </p>
            
            <p>Prezime:
        <input type="text" name="prezime" size="30" value="" />
        </p>
        
        
            <p>Godina:
        <input type="text" name="godina" size="30" value="" />
        </p>
            
            <p>Visina:
        <input type="text" name="visina" size="30" value="" />
        </p>
        
            <p>Tezina:
        <input type="text" name="tezina" size="30" value="" />
        </p>
        
            <p>Mjesto_rodenja:
        <input type="text" name="mjesto_rodenja" size="30" value="" />
        </p>
        
            <p>Tim:
        <input type="text" name="tim" size="30" value="" />
        </p>
        
        <p>
            <input type="submit" name="posalji" value="Pošalji" />
        </p>
        
        
        </form>
        
    </body>
</html>
