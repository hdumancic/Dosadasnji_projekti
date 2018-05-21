<!DOCTYPE html>
<?php
include("./baza.class.php");

$modPrijava = "true";
$modRegistracija = "true";
$pogresanUnos = "";
$dobiveniMod = "";
$spajanje = new Baza();
$spajanje->spojiDB();

if(isset($_GET['mod']))
{
    $dobiveniMod = trim($_GET['mod']);
    
    if($dobiveniMod == "modPrijava")
    {
        $modPrijava = "true";
        $modRegistracija = "false";
    }
    else
    {
        $modRegistracija = "true";
        $modPrijava = "false";
    }
}
?>

<html>
    <head>
        <title>Prijava i registracija - Green Bay</title>
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
            <h1 class="naslov">Prijava i registracija</h1>
            <div id="sadrzajPrijavaRegistracija">
                    <?php
                        if($modPrijava == "true")
                        {
                    ?>
                        <div class="sadrzajPrijava" id="sadrzajPrijava">
                            <h2>Prijava</h2>
                            <form class="formPrijava" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <p>
                                    <label for="prijavaKorisnickoIme">Korisničko ime: </label><br class="prijavaBreakMobile">
                                    <input type="text" id="prijavaKorisnickoIme" name="prijavaKorisnickoIme" maxlength="20" size="20" placeholder="Korisničko ime"><br class="prijavaBreak">
                                    <label for="prijavaLozinka">Lozinka: </label><br class="prijavaBreakMobile">
                                    <input type="password" id="prijavaLozinka" name="prijavaLozinka" placeholder="Lozinka"><br class="prijavaBreak">
                                    <input type="checkbox" name="prijavaZapamti" value="1">Upamti korisničko ime<br class="prijavaBreak">
                                    <input type="submit" value="Prijavi se"><br class="prijavaBreakMobile">
                                    <input type="reset" value="Inicijaliziraj">
                                </p>
                            </form>
                            <p>Korisnicko Ime: 'hrvoje123' Lozinka: 'test123'</p>
                            <?php
                                if($modPrijava == "true")
                                {
                                    if(!empty($_POST["prijavaKorisnickoIme"]))
                                    {
                                        $upisanoKorime = $_POST["prijavaKorisnickoIme"];
                                        $upisanaLozinka = $_POST["prijavaLozinka"];
                                        if($upisanoKorime == "" || $upisanaLozinka == "")
                                        {
                                            echo "<p class='greska'>Neuspjesna prijava!</p>";
                                            return;
                                        }
                                        $ulazakUPodatke = "";
                                        $poslaniUpitPrijava = $spajanje->selectDB("SELECT * FROM `zadaca04_prijavaRegistracija` WHERE `korisnickoIme`='".$upisanoKorime."' AND `lozinka_citljivo`='".$upisanaLozinka."'");
                                        while($redakPrijava = mysqli_fetch_array($poslaniUpitPrijava))
                                        {
                                            if($redakPrijava['lozinka_citljivo'] == $upisanaLozinka && $redakPrijava['korisnickoIme'] == $upisanoKorime)
                                            {
                                                echo "<p>Prijavljeni ste!</p>";
                                                $ulazakUPodatke = "true";
                                                break;
                                            }
                                        }
                                        if($ulazakUPodatke == NULL)
                                        {
                                            echo "<p class='greska'>Neuspjesna prijava!</p>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <p id="razmakPrijavaRegistracija"></p>
                    <?php
                        }
                        
                        if($modRegistracija == "true")
                        {
                    ?>
                        <div class="sadrzajRegistracija" id="sadrzajRegistracija">
                            <h2>Registracija</h2>
                            <form class="formRegistracija" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <p>
                                    <label for="registracijaIme">Ime: </label><br class="registracijaBreakMobile">
                                    <input type="text" id="registracijaIme" name="registracijaIme" maxlength="30" size="20" placeholder="Ime"><br class="registracijaBreak">
                                    <label for="registracijaPrezime">Prezime: </label><br class="registracijaBreakMobile">
                                    <input type="text" id="registracijaPrezime" name="registracijaPrezime" maxlength="50" size="20" placeholder="Prezime"><br class="registracijaBreak">
                                    <label for="registracijaKorisnickoIme">Korisničko ime:</label><br class="registracijaBreakMobile">
                                    <input type="text" id="registracijaKorisnickoIme" name="registracijaKorisnickoIme" maxlength="20" placeholder="Korisničko ime"><br class="registracijaBreak">
                                    <label for="registracijaEmail">Email: </label><br class="registracijaBreakMobile">
                                    <input type="text" id="registracijaEmail" name="registracijaEmail" size="25" placeholder="ime.prezime@poslužitelj.xxx"><br class="registracijaBreak">
                                    <label for="registracijaLozinka">Lozinka: </label><br class="registracijaBreakMobile">
                                    <input type="password" id="registracijaLozinka" name="registracijaLozinka" placeholder="Lozinka"><br class="registracijaBreak">
                                    <label for="registracijaLozinkaPotvrda">Potvrda lozinke: </label><br class="registracijaBreakMobile">
                                    <input type="password" id="registracijaLozinkaPotvrda" name="registracijaLozinkaPotvrda" placeholder="Lozinka"><br class="registracijaBreak"><br class="registracijaBreak">
                                    <input type="submit" id="registracijaSubmit" value="Registriraj se"><br class="registracijaBreak"><br class="registracijaBreakMobile">
                                    <a href="#sadrzajPrijava" id="buttonSadrzajPrijava">Obrazac prijava</a>
                                    <?php
                                            if(!empty($_POST["registracijaIme"]))
                                            {
                                                foreach ($_POST as $param_name => $param_val) {

                                                    if(preg_match("/[!?#']/", $param_val))
                                                    {
                                                        echo "<p class='greska'>Podaci ne smiju sadrzavati nedozvoljene znakove!</p>";
                                                        $pogresanUnos = "da";
                                                        break;
                                                    }
                                                    if($param_val == NULL)
                                                    {
                                                        echo "<p class='greska'>Sva polja moraju biti ispunjena!</p>";
                                                        $pogresanUnos = "da";
                                                        break;
                                                    }
                                                }

                                                if($_POST["registracijaEmail"])
                                                {
                                                    if(!preg_match("/^([a-zA-Z0-9])+((\.)?)([a-zA-Z0-9]?)+(?=@)(@[a-zA-Z0-9]+)\.{1}([a-zA-Z0-9]{2,})$/", $_POST["registracijaEmail"]))
                                                    {
                                                        echo "<p class='greska'>Format email-a nije odgovarajuci!</p>";
                                                        $pogresanUnos = "da";
                                                    }
                                                    if(!preg_match("/^[a-z0-9.@]{10,30}$/", $_POST["registracijaEmail"]))
                                                    {
                                                        echo "<p class='greska'>Format email-a nije odgovarajuci!</p>";
                                                        $pogresanUnos = "da";
                                                    }
                                                }

                                                if($_POST["registracijaLozinka"] != $_POST["registracijaLozinkaPotvrda"])
                                                {
                                                    echo "<p class='greska'>Oba unosa lozinke moraju biti identicna!</p>";
                                                    $pogresanUnos = "da";
                                                }
                                                $dohvaceniPodaci = $spajanje->selectDB("SELECT `email`, `korisnickoIme` FROM `zadaca04_prijavaRegistracija`;");
                                                while($redakZaglavlje = mysqli_fetch_array($dohvaceniPodaci))
                                                {
                                                    if($redakZaglavlje['email'] == $_POST["registracijaEmail"] || $redakZaglavlje['korisnickoIme'] == $_POST["registracijaKorisnickoIme"])
                                                    {
                                                        echo "<p class='greska'>Takav email i korisnicko ime vec postoji!</p>";
                                                        $pogresanUnos = "da";
                                                        break;
                                                    }
                                                }

                                                if($pogresanUnos == NULL)
                                                {
                                                    $regIme = $_POST['registracijaIme'];
                                                    $regPrezime = $_POST['registracijaPrezime'];
                                                    $regKorime = $_POST['registracijaKorisnickoIme'];
                                                    $regEmail = $_POST['registracijaEmail'];
                                                    $regLozinka = $_POST['registracijaLozinka'];
                                                    $sol = sha1(time());

                                                    $regLozinkaKod = sha1($sol ."-".$regLozinka);

                                                    $insertDB = "INSERT INTO `zadaca04_prijavaRegistracija` (`ime`, `prezime`, `korisnickoIme`, `email`, `lozinka_citljivo`, `lozinka_kriptirano`)";
                                                    $insertDB .= " VALUES ('$regIme', '$regPrezime', '$regKorime', '$regEmail', '$regLozinka', '$regLozinkaKod')";
                                                    $spajanje->updateDB($insertDB);
                                                    $spajanje->zatvoriDB();
                                                }
                                            }
                                    ?>
                            </form>
                        </div>
                    
                    <?php
                        }
                    ?>
            </div>
        </div>
        
        <footer class="podnozje">
            Vrijeme potrebno za izradu: 20h<br><br>
            <a href="https://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2017/zadaca_04/hdumancic/prijavaRegistracija.php" title="HTML 5 validacija">
                <img src="slike/HTML5.png" alt="validacijaHTML5" height="55" width="50" class="validacijskiLink"/></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://webdip.barka.foi.hr/2017/zadaca_04/hdumancic/hdumancic.css" title="CSS 3 validacija">
                <img src="slike/CSS3.png" alt="validacijaCSS3" height="55" width="55" class="validacijskiLink"/></a>
        </footer>
    </body>
</html>
