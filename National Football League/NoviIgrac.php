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
        
        if(isset($_POST['posalji']))
        {
            $nedostajuci_podaci = array();
            
            if(empty($_POST['ime'])){
                $nedostajuci_podaci[] = 'Ime igraca';
            } else{
                $Ime = trim($_POST['ime']);
            }
            
            if(empty($_POST['prezime'])){
                $nedostajuci_podaci[] = 'Prezime igraca';
            } else{
                $Prezime = trim($_POST['prezime']);
            }
            
            if(empty($_POST['godina'])){
                $nedostajuci_podaci[] = 'Godine igraca';
            } else{
                $Godina = trim($_POST['godina']);
            }
            
            if(empty($_POST['visina'])){
                $nedostajuci_podaci[] = 'Visina igraca';
            } else{
                $Visina = trim($_POST['visina']);
            }
            
            if(empty($_POST['tezina'])){
                $nedostajuci_podaci[] = 'Tezina igraca';
            } else{
                $Tezina= trim($_POST['tezina']);
            }
            
            if(empty($_POST['mjesto_rodenja'])){
                $nedostajuci_podaci[] = 'Mjesto rodenja igraca';
            } else{
                $Mjesto_rodenja = trim($_POST['mjesto_rodenja']);
            }
            
            if(empty($_POST['tim'])){
                $nedostajuci_podaci[] = 'Tim igraca';
            } else{
                $Tim = trim($_POST['tim']);
            }
            
            
            if(empty($nedostajuci_podaci)){
                
                require_once('../konekcija.php');
                
                $upit = "INSERT INTO igrac (igrac_id, ime, prezime, godina, visina, tezina, mjesto_rodenja, tim_id)
                    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
                        
                $stmt = mysqli_prepare($db_connect, $upit);

                    
                mysqli_stmt_bind_param($stmt, 'ssiiisi', $Ime, $Prezime, $Godina, $Visina, $Tezina, $Mjesto_rodenja, $Tim);
                
                mysqli_stmt_execute($stmt);
                
                $obuhvaceni_redovi = mysqli_stmt_affected_rows($stmt);
                
                if($obuhvaceni_redovi == 1)
                {
                    echo 'Igrac je uspjesno upisan!<br />';
                    
                    mysqli_stmt_close($stmt);
                    
                    mysqli_close($db_connect);
                
                    
                }else{
                    echo 'Doslo je do greske<br />Igrac nije upisan<br />';
                    echo mysqli_error();
                    mysqli_stmt_close($stmt);
                    mysqli_close($db_connect);
                
                }
             } else{
                echo 'Niste upisali sve potrebne podatke!<br />';
                foreach($nedostajuci_podaci as $prazna_polja){ 
                    
                    echo "$prazna_polja<br />";
                }
             
                 
             }
        }
        
        
        ?>
        
        
    <form action="http://localhost/Baze2_Projekt/NoviIgrac.php" method="post">
                     
    <b>Dodaj novog igraca </b>
    <p>
        
        <table align="left|right|center"
               border="1" cellspacing="" cellpadding="10">
            
            <tr><td align="center"><b>Ime  <input type="text" name="ime" size="15" value="" /> </b></td>
            <td align="center"><b>Prezime <input type="text" name="prezime" size="30" value="" /> </b></td>
            <td align="center"><b>Godina <input type="text" name="godina" size="5" value="" /> </b></td>
            <td align="center"><b>Visina <input type="text" name="visina" size="5" value="" /> </b></td>
            <td align="center"><b>Tezina <input type="text" name="tezina" size="5" value="" /> </b></td>
            <td align="center"><b>Mjesto rodenja <input type="text" name="mjesto_rodenja" size="30" value="" /> </b></td>
            <td align="center"><b>Tim ID <input type="text" name="tim" size="30" value="" /> </b></td></tr>

        </table>
    
    <p>
    
    <input type="submit" name="posalji" value="Pošalji" />
    
    
    </p>
        
        
    </form>

    </body>
</html>
