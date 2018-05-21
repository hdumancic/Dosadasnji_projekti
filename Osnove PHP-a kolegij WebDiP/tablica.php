<!DOCTYPE html>
<?php

include("./baza.class.php");
$upitPodaci = "SELECT * FROM `zadaca04_obrazac`;";
$spajanje = new Baza();
$spajanje->spojiDB();
$ispisPodataka = $spajanje->selectDB($upitPodaci);
$ulazakKategorija = "false";
$datumOdFormat = "";
$datumDoFormat = "";
$brojac = 0;

if(isset($_GET["odabirVrsteIgre"]))
{
    $odabranaVrsta = $_GET["odabirVrsteIgre"];
    if($odabranaVrsta != "sve_opcije")
    {
        $ispisPodataka = $spajanje->selectDB("SELECT * FROM `zadaca04_obrazac` WHERE `vrstaIgre` LIKE '%".$odabranaVrsta."%'");
        $ulazakKategorija = "true";
    }
}

if(isset($_GET["timUzlazno"]))
{
    $ispisPodataka = $spajanje->selectDB("SELECT * FROM `zadaca04_obrazac` ORDER BY `klub` ASC");
}
elseif(isset($_GET["timSilazno"]))
{
    $ispisPodataka = $spajanje->selectDB("SELECT * FROM `zadaca04_obrazac` ORDER BY `klub` DESC");
}
elseif(isset($_GET["visinaUzlazno"]))
{
    $ispisPodataka = $spajanje->selectDB("SELECT * FROM `zadaca04_obrazac` ORDER BY `visina` ASC");
}
elseif(isset($_GET["visinaSilazno"]))
{
    $ispisPodataka = $spajanje->selectDB("SELECT * FROM `zadaca04_obrazac` ORDER BY `visina` DESC");
}
elseif($ulazakKategorija == "false")
{
    $ispisPodataka = $spajanje->selectDB($upitPodaci);
}


if(!empty($_GET["datumOd"]) && !empty($_GET["datumDo"]))
{
    $datumOd = explode('.', $_GET["datumOd"]);
    $datumOdFormat = $datumOd[2] . "-" . $datumOd[1] . "-" . $datumOd[0];
    $datumDo = explode('.', $_GET["datumDo"]);
    $datumDoFormat = $datumDo[2] . "-" . $datumDo[1] . "-" . $datumDo[0];
    $ispisPodataka = $spajanje->selectDB("SELECT * FROM `zadaca04_obrazac` WHERE DATE(`datumVrijeme`) BETWEEN '".$datumOdFormat."' AND '".$datumDoFormat."';");
}

?>
    <head>
        <title>Tablica - Green Bay</title>
        <meta charset="UTF-8">
        <meta name="author" content="Hrvoje Dumančić">
        <meta name="naslov" content="zadaca01">
        <meta name="zadnja_izmjena" content="18-3-2018">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/hdumancic.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <header>
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
            <aside class="navigacija">
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
            <h1 class="naslov">Tablica</h1>
            <div id="sadrzajTablica">
                    <table class="tablica" id="tablicaTable">
                        <caption class="tablica">National Football League</caption>
                        <thead class="tablica">
                            <tr class="tablicaZaglavlje">
                                <?php
                                    $dohvaceniStupci = $spajanje->selectDB("SHOW COLUMNS FROM `zadaca04_obrazac`");
                                    while($redakZaglavlje = mysqli_fetch_array($dohvaceniStupci))
                                    {
                                        if($redakZaglavlje['Field'] != "datoteka")
                                        {
                                            echo "<td>" . $redakZaglavlje['Field'] . "</td>";
                                        }
                                    }
                                    $spajanje->zatvoriDB();
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($redak = mysqli_fetch_array($ispisPodataka)){
                                    echo "<tr class='tablicaPodaci'>";
                                    echo "<td>" . $redak["idObrasca"] . "</td>";
                                    echo "<td>" . $redak["klub"]. "</td>";
                                    echo "<td>" . $redak["klubOpis"]. "</td>";
                                    echo "<td>" . $redak["datumVrijeme"]. "</td>";
                                    echo "<td>" . $redak["brojDresa"]. "</td>";
                                    echo "<td>" . $redak["visina"]. "</td>";
                                    echo "<td>" . $redak["vrstaIgre"]. "</td>";
                                    echo "<td>" . $redak["pozicijaIgre"]. "</td>";
                                    echo "<td>" . $redak["najdraziIgrac"]. "</td>";
                                    echo "</tr>";
                                    $brojac++;
                                }
                                if($brojac == 0)
                                {
                                    echo "<tr class='tablicaPodaci'>";
                                    echo "<td colspan='9' >Nema podataka za dane parametre</td>";
                                }
                            ?>
                        </tbody>
                    </table><br>
                    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <button name="timUzlazno" id="timUzlazno">Sortiranje po nazivu tima uzlazno</button>
                        <button name="timSilazno" id="timSilazno">Sortiranje po nazivu tima silazno</button><br><br>
                        <button name="visinaUzlazno" id="visinaUzlazno">Sortiranje po visini uzlazno</button>
                        <button name="visinaSilazno" id="visinaSilazno">Sortiranje po visini silazno</button><br><br>
                        <select id="odabirVrsteIgre" name="odabirVrsteIgre">
                            <option value="napad">Napad</option>
                            <option value="obrana">Obrana</option>
                            <option value="specijalni_tim">Specijalni tim</option>
                            <option value="sve_opcije" selected>Sve opcije</option>
                        </select>
                        <button name="filterPodataka" id="filterPodataka">Ispis po vrsti igre</button><br><br>
                        <input type="text" name="datumOd" placeholder="dd.mm.gggg">
                        <input type="text" name="datumDo" placeholder="dd.mm.gggg">
                        <button name="filterDatuma" id="filterDatuma">Filtriraj datum</button>
                    </form>
                <div id="razmakIznadStranice"></div>
                <iframe id="prozorStranice" src="http://backstageincome.com" ></iframe><br>
            </div>
        </div>
        
        <footer class="podnozje">
            Vrijeme potrebno za izradu: 20h<br><br>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_04/hdumancic/tablica.php" title="HTML 5 validacija">
                <img src="slike/HTML5.png" alt="validacijaHTML5" height="55" width="50" class="validacijskiLink"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://webdip.barka.foi.hr/2017/zadaca_04/hdumancic/hdumancic.css" title="CSS 3 validacija">
                <img src="slike/CSS3.png" alt="validacijaCSS3" height="55" width="55" class="validacijskiLink"/></a>
        </footer>
    </body>
</html>

