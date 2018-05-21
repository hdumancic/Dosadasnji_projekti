<!DOCTYPE html>
<html>
<?php

$prazanUnos = "";
$poslaniParametar = "";

?>
    <head>
        <title>Obrazac - Green Bay</title>
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
            <h1 class="naslov">Obrazac</h1>
                <div id="sredisteObrazac">
                    <div id="sadrzajObrazac">
                        <?php
                            if(!isset($_COOKIE["prvi_dolazak"]))
                                {
                                    $naziv_kolacica = "prvi_dolazak";
                                    $vrijedi_do = time() + 60*60*24;
                                    setcookie($naziv_kolacica, 0, $vrijedi_do);
                                    echo "<p>Ova stranica sprema kolačiće!</p>";
                                }
                        ?>
                        <h2>Ispunjavanje obrasca</h2>
                            <form id="formObrazac" enctype="multipart/form-data" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                
                                    <fieldset class="okvirObrasca">
                                    <legend>Odabir tima</legend>
                                        <input type="file" name="odaberiDatoteku" >Odaberite datoteku<br class="obrazacBreak">
                                        <?php
                                            if(!empty($_GET)){
                                                $krivaDatoteka = "";
                                                
                                                if($_GET["odaberiDatoteku"] == NULL){
                                                    echo "<p class='greska'>Polje odabira datoteke ne smije biti prazno!</p>";
                                                    $prazanUnos .= "Odabir datoteke" . "<br>";
                                                }
                                                else
                                                {
                                                    if(preg_match("/^[a-zA-Z0-9._!-]+\.{1}[j]{1}[p]{1}[g]{1}/", $_GET["odaberiDatoteku"])){
                                                        $krivaDatoteka = "false";
                                                    }
                                                    elseif(preg_match("/^[a-zA-Z0-9._!-]+\.{1}[p]{1}[n]{1}[g]{1}/", $_GET["odaberiDatoteku"]))
                                                    {
                                                        $krivaDatoteka = "false";
                                                    }
                                                    if($krivaDatoteka == NULL)
                                                    {
                                                        echo "<p class='greska'>Neodgovarajuci format uploadane datoteke!</p>";
                                                        $prazanUnos .= "Format datoteke" . "<br>";
                                                    }
                                                }
                                            }
                                        ?>
                                        <input list="odabraniKlub" placeholder="Odaberite klub" name="odabraniKlub" id="odabraniKlubIzbor">
                                        <datalist id="odabraniKlub">
                                            <?php
                                                $ime_dat = "odabraniKlub.txt";
                                                $klubovi = file ($ime_dat);
                                                while( list($redni_broj, $klub) = each($klubovi))
                                                {
                                                    $ime_kluba = htmlspecialchars(trim($klub));
                                                    print "<option value=\"$ime_kluba\">$ime_kluba</option>\n";
                                                }
                                            ?>
                                        </datalist>
                                        <br class="obrazacBreakMobile">
                                        <label for="odabraniKlubIzbor"> Odaberite klub</label><br class="obrazacBreak">
                                        <?php
                                            if(!empty($_GET)){
                                                if($_GET["odabraniKlub"] == NULL){
                                                    echo "<p class='greska'>Polje odabira kluba ne smije biti prazno!</p>";
                                                    $prazanUnos .= "Odabir kluba" . "<br>";
                                                }
                                                else{
                                                    $izabraniKlub = $_GET["odabraniKlub"];
                                                    $pronadenKlub = "";

                                                    $ime_dat = "odabraniKlub.txt";
                                                    $klubovi = file ($ime_dat);
                                                    while( list($redni_broj, $klub) = each($klubovi)){
                                                        $ime_kluba = htmlspecialchars(trim($klub));
                                                        if($izabraniKlub == $ime_kluba)
                                                        {
                                                            $pronadenKlub = "pronaden";
                                                            break;
                                                        }
                                                    }
                                                    if($pronadenKlub == NULL){
                                                        echo "<p class='greska'>Izabrani klub se ne nalazi na popisu klubova!</p>";
                                                        $prazanUnos .= "Izabrani klub nije na popisu klubova" . "<br>";
                                                    }

                                                    for($i=0; $i < strlen($izabraniKlub); $i++){
                                                        if($izabraniKlub[$i] == "'" || $izabraniKlub[$i] == "!" || $izabraniKlub[$i] == "?" || $izabraniKlub[$i] == "#")
                                                        {
                                                            echo "<p class='greska'>Polje odabir kluba sadrzi nedozvoljene znakove!</p>";
                                                            $prazanUnos .= "Polje odabir kluba sadrzi nedozvoljene znakove" . "<br>";
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        <textarea id="odabraniKlubOpis" name="odabraniKlubOpis" rows="40" cols="60" maxlength="580" placeholder="Green Bay Packersi su američki nogometni tim iz grada Green Bay, u sjevernoj saveznoj državi Wisconsin."></textarea><br class="obrazacBreak">
                                        <label for="odabraniKlubOpis"> Opišite klub</label><br class="obrazacBreak">
                                        <?php
                                            if(!empty($_GET)){
                                                if($_GET["odabraniKlubOpis"] == NULL){
                                                    echo "<p class='greska'>Viselinijsko tekstualno polje ne smije biti prazno!</p>";
                                                    $prazanUnos .= "Prazno viselinijsko tekstualno polje" . "<br>";
                                                }
                                                else{
                                                    $odabraniKlubOpis = $_GET["odabraniKlubOpis"];
                                                    for($i = 0; $i < strlen($odabraniKlubOpis); $i++)
                                                    {
                                                        if($odabraniKlubOpis[$i] == "'" || $odabraniKlubOpis[$i] == "?" || $odabraniKlubOpis[$i] == "!" || $odabraniKlubOpis[$i] == "#" )
                                                        {
                                                            echo "<p class='greska'>Viselinijsko tektstualno polje sadrzi nedozvoljene znakove!</p>";
                                                            $prazanUnos .= "Viselinijsko tekstualno polje sadrzi nedozvoljene znakove" . "<br>";
                                                            break;
                                                        }
                                                    }

                                                    if(strlen($odabraniKlubOpis) < 5){
                                                        echo "<p class='greska'>Viselinijsko tekstualno polje mora imati vise od 5 znakova!</p>";
                                                        $prazanUnos .= "Viselinijsko tekstualno polje ima manje od 5 znakova" . "<br>";
                                                    }

                                                    $prvoSlovo = $odabraniKlubOpis[0];
                                                    if($prvoSlovo != strtoupper($prvoSlovo)){
                                                        echo "<p class='greska'>Prvo slovo viselinijskog tekstualnog polja mora biti veliko!</p>";
                                                        $prazanUnos .= "Viselinijsko tekstualno polje za prvi znak ima malo slovo" . "<br>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </fieldset>
                                    <div id="razmakObrazac"></div>
                                    <fieldset class="okvirObrasca">
                                    <legend>Upis osobnih podataka</legend>
                                    
                                        <input type="text" id="datumVrijemeOdabira" name="datumVrijemeOdabira" placeholder="dd.mm.gggg hh:mm"><br class="obrazacBreakMobile">
                                        <label for="datumVrijemeOdabira"> Unesite datum i vrijeme</label><br class="obrazacBreak">
                                        <?php
                                            if(!empty($_GET)){
                                                if($_GET["datumVrijemeOdabira"] == NULL){
                                                    echo "<p class='greska'>Polje za upis datuma i vremena ne smije biti prazno!</p>";
                                                    $prazanUnos .= "DatumVrijeme upis ne smije biti prazan" . "<br>";
                                                }
                                                else{
                                                    if(!preg_match("/^[0-9]{2}.{1}[0-9]{2}.{1}[0-9]{4}\s[0-9]{2}:{1}[0-9]{2}$/", $_GET["datumVrijemeOdabira"]))
                                                    {
                                                        echo "<p class='greska'>Polje za upis datuma i vremena nije u odgovarajucem formatu!</p>";
                                                        $prazanUnos .= "DatumVrijeme upis nije u odgovarajucem formatu" . "<br>";
                                                    }
                                                }
                                            }
                                        ?>
                                        <input type="number" id="odabraniBroj" name="odabraniBroj" min="1" max="99"><br class="obrazacBreakMobile">
                                        <label for="odabraniBroj">Odaberite broj dresa (1-99) </label><br class="obrazacBreak">

                                        <label for="odabirVisine" id="odabirVisineLabel1">Odaberite visinu: 150cm</label><br class="obrazacBreakMobile">
                                        <input type="range" id="odabirVisine" name="odabirVisine" min="150" max="210"><br class="obrazacBreakMobile">
                                        <label for="odabirVisine" id="odabirVisineLabel2"> 210cm</label><br class="obrazacBreak">
                                        
                                        <select id="odabirVrsteIgre" name="odabirVrsteIgre[]" multiple>
                                            <option selected value="napad">Napad</option>
                                            <option value="obrana">Obrana</option>
                                            <option value="specijalni_tim">Specijalni tim</option>
                                            <option value="sve_opcije">Sve opcije</option>
                                        </select><br class="obrazacBreakMobile">
                                        <label for="odabirVrsteIgre">Odabir vrste igre</label><br class="obrazacBreak">
                                        <?php
                                            if(!empty($_GET))
                                            {
                                                if(count($_GET["odabirVrsteIgre"]) < 2)
                                                {
                                                    echo "<p class='greska'>Moraju se odabrani najmanje dvije kategorije!</p>";
                                                        $prazanUnos .= "Neodgovarajuci broj izabranih kategorija" . "<br>";
                                                }
                                            }
                                        ?>

                                        <select id="odabirPozicijeIgre" name="odabirPozicijeIgre">
                                            <optgroup label="Napad"></optgroup>
                                            <option value="quarterback">Proigravač</option>
                                            <option value="wide_receiver">Hvatač</option>
                                            <option value="bloker">Bloker</option>

                                            <optgroup label="Obrana"></optgroup>
                                            <option value="branic" selected>Branič</option>
                                            <option value="drzac">Držač</option>
                                            <option value="specijalni_tim">Specijalni tim</option>

                                            <optgroup label="Specijalni tim"></optgroup>
                                            <option value="drzac">Držač</option>
                                            <option value="specijalni_tim">Specijalni tim</option>
                                            <option value="sve_opcije">Udarač</option>

                                            <optgroup label="Udarač"></optgroup>
                                            <option value="dodatni_bod">Dodatni bod</option>
                                            <option value="ispucavanje">Ispucavanje</option>
                                        </select><br class="obrazacBreakMobile">
                                        <label for="odabirPozicijeIgre">Odabir pozicije igre</label><br class="obrazacBreak">
                                            
                                        <select id="odabirNajdrazegIgraca" name="odabirNajdrazegIgraca">
                                                <option value="rodgers">Aaron Rodgers</option>
                                                <option value="brady">Tom Brady</option>
                                                <option value="clinton">Ha-ha Clinton Dix</option>
                                                <option value="lynch">Marshawn Lynch</option>
                                                <option value="nelson">Jordie Nelson</option>
                                        </select><br class="obrazacBreakMobile">
                                        <label id="odabirNajdrazegIgracaLabel" for="odabirNajdrazegIgraca">Odabir najdražeg igrača</label><br class="obrazacBreak">
                                        
                                        <input type="submit" value="Pošalji">
                                        <?php
                                        
                                            if(!empty($_GET))
                                            {
                                                if($prazanUnos == NULL)
                                                {
                                                    require("./baza.class.php");
                                                    $spajanje = new Baza();
                                                    $spajanje->spojiDB();
                                                    
                                                    
                                                    $datumVrijeme = $_GET["datumVrijemeOdabira"];
                                                    $dobivenDatumVrijeme = explode(' ', $datumVrijeme);
                                                    $dobivenDatum = explode('.', $dobivenDatumVrijeme[0]);
                                                    $dobivenoVrijeme = explode(':', $dobivenDatumVrijeme[1]);
                                                    $datumVrijeme = $dobivenDatum[2] . "-" . $dobivenDatum[1] . "-" . $dobivenDatum[0];
                                                    $datumVrijeme .= " " . $dobivenoVrijeme[0] . ":" . $dobivenoVrijeme[1];
                                                    
                                                    $odabranaDatoteka = $_GET["odaberiDatoteku"];
                                                    $odabraniKlub = $_GET["odabraniKlub"];
                                                    $opisKluba = $_GET["odabraniKlubOpis"];
                                                    $odabraniBroj = $_GET["odabraniBroj"];
                                                    $odabranaVisina = $_GET["odabirVisine"];
                                                    $vrstaIgre = $_GET["odabirVrsteIgre"];
                                                    $vrstaIgreString =  implode(" ", $vrstaIgre);
                                                    $odabirPozicije = $_GET["odabirPozicijeIgre"];
                                                    $odabirIgraca = $_GET["odabirNajdrazegIgraca"];
                                                
                                                    $insertDB = "INSERT INTO `zadaca04_obrazac` (`datoteka`, `klub`, `klubOpis`, `datumVrijeme`, `brojDresa`, `visina`, "
                                                    . "`vrstaIgre`, `pozicijaIgre`, `najdraziIgrac`) "
                                                    . "VALUES ('$odabranaDatoteka','$odabraniKlub',"
                                                    . " '$opisKluba','$datumVrijeme',$odabraniBroj,$odabranaVisina,'$vrstaIgreString',"
                                                    . " '$odabirPozicije','$odabirIgraca')";
                                                    
                                                    $spajanje->updateDB($insertDB);
                                                    $spajanje->zatvoriDB();
                                                    echo '<script> window.location = "tablica.php";</script>';
                                                }   
                                                
                                                else
                                                {
                                                    echo "<p class='greska'>Onemogucen unos u bazu zbog neodgovarajucih podataka</p>";
                                                }
                                            }
                                            
                                        ?>
                                    </fieldset>
                                
                            </form>
                    </div>
                </div>
        </div>
        <footer class="podnozje">
            Vrijeme potrebno za izradu: 20h<br><br>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_04/hdumancic/obrazac.php" title="HTML 5 validacija">
                <img src="slike/HTML5.png" alt="validacijaHTML5" height="55" width="50" class="validacijskiLink"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://webdip.barka.foi.hr/2017/zadaca_04/hdumancic/hdumancic.css" title="CSS 3 validacija">
                <img src="slike/CSS3.png" alt="validacijaCSS3" height="55" width="55" class="validacijskiLink"/></a>
            
        </footer>
    </body>
</html>
