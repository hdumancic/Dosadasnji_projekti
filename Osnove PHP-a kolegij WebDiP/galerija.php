<!DOCTYPE html>
<?php
include("./baza.class.php");
?>
<html>
    <head>
        <title>Galerija - Green Bay</title>
        <meta charset="UTF-8">
        <meta name="author" content="Hrvoje Dumančić">
        <meta name="naslov" content="zadaca01">
        <meta name="zadnja_izmjena" content="18-3-2018">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/hdumancic.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header id="headerGalerija"> 
            <div class="zaglavlje">
                <div class="naslovZaglavlja"><h3>Green Bay Packers</h3></div>
                <div class="tekstZaglavlja" dir="rtl">
                    .2018 .Ožujak 18<br>
                    20:00<br>
                    <a href="prijavaRegistracija.php?mod=modPrijava" class="zaglavljePrijava">Prijava</a>
                </div>
            </div>
        </header>
        <div class="srediste">
            <aside class="navigacija" id="navigacijaGalerija">
                <h3 class="navigacijaNaslov">Navigacija</h3>
                    <nav class="navigacijaIzbornik">
                        <ol type="1">
                            <li> <a href="galerija.php" class="navigacijaIzbor">Galerija</a></li>
                            <li> <a href="prijavaRegistracija.php?mod=modPrijava" class="navigacijaIzbor">Prijava</a></li>
                            <li> <a href="prijavaRegistracija.php?mod=modRegistracija" class="navigacijaIzbor">Registracija</a></li>
                            <li><a href="obrazac.php" class="navigacijaIzbor">Obrazac</a></li>
                            <li> <a href="tablica.php" class="navigacijaIzbor">Tablica</a></li>
                        </ol>
                    </nav>
            </aside>
            <h1 class="naslov" id="naslovGalerija">Galerija</h1>
            <div id="sadrzajGalerija">
                <?php
                    $spajanje = new Baza();
                    $spajanje->spojiDB();
                    $ispisPodataka = $spajanje->selectDB("SELECT `datoteka`, `klubOpis` FROM `zadaca04_obrazac`");
                    while($redak = mysqli_fetch_array($ispisPodataka)){
                        echo "<p>";
                        echo "<figure>";
                        echo "<img class='dodanaSlika' src='slike/".$redak['datoteka']."' alt='dodanaSlika'>";
                        echo "<figcaption>".$redak['klubOpis']."</figcaption>";
                        echo "</figure>";
                        echo "</p>";
                    }
                    $spajanje->zatvoriDB();
                ?>
            </div>
        </div>
        <footer class="podnozje"  id="footerGalerija">
            Vrijeme potrebno za izradu: 20h<br><br>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_04/hdumancic/galerija.php" title="HTML 5 validacija">
                <img src="slike/HTML5.png" alt="validacijaHTML5" height="55" width="50" class="validacijskiLink"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://webdip.barka.foi.hr/2017/zadaca_04/hdumancic/hdumancic.css" title="CSS 3 validacija">
                <img src="slike/CSS3.png" alt="validacijaCSS3" height="55" width="55" class="validacijskiLink"/></a>
        </footer>
    </body>
</html>
