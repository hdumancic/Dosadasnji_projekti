
// registracija - onemogucivanje unosa imena, prezimena i korisnickog imena

$(document).ready(function(){

    $('#registracijaIme').attr('disabled', 'disabled');
    $('#registracijaPrezime').attr('disabled', 'disabled');
    $('#registracijaKorisnickoIme').attr('disabled', 'disabled');
    $('#izlazak').css('display','none');
    $('#registracijaCheckbox').css('border-color','#f2b632');
    


    var index = 0;
    var odabranaDrzavaPozivniBroj;
    var odabranaDrzava;
    novaFunkcija();
    
    $(document).on('click', '.ucitajJosGumb', function(){
        novaFunkcija();
    });
    
    
    $(document).on('click', '.registracijaCheckbox', function(){
       odabranaDrzavaPozivniBroj = $(this).attr('id');
    });
    
    $(document).on('click','#registracijaSubmit',function(event){
       odabranaDrzava = $('#registracijaDrzava').val();
       if($('#registracijaEmail').val() === "")
       {
           alert("Morate upisati E-mail!");
           $('#registracijaEmail').css('background-color','red');
           event.preventDefault();
           return;
       }
       if($('#registracijaIme').val() === "" || $('#registracijaPrezime').val() === "" || $('#registracijaKorisnickoIme').val() === "")
       {
           alert("Niste upisali potrebne korisničke podatke!");
           $('#registracijaIme').css('background-color','red');
           $('#registracijaPrezime').css('background-color','red');
           $('#registracijaKorisnickoIme').css('background-color','red');
           event.preventDefault();
           return;
       }
       else
       {
           $('#registracijaIme').css('background-color','white');
           $('#registracijaPrezime').css('background-color','white');
           $('#registracijaKorisnickoIme').css('background-color','white');
       }
       if($('#registracijaLozinka').val() === "" || $('#registracijaLozinkaPotvrda').val() === "")
       {
           alert("Niste upisali potrebne korisničke podatke!");
           $('#registracijaLozinka').css('background-color','red');
           $('#registracijaLozinkaPotvrda').css('background-color','red');
           event.preventDefault();
           return;
       }
       else
       {
           $('#registracijaLozinka').css('background-color','white');
           $('#registracijaLozinkaPotvrda').css('background-color','white');
       }
       if($('#registracijaLozinka').val() !== $('#registracijaLozinkaPotvrda').val())
       {
           alert("Lozinka i potvrda lozinke moraju imati istu vrijednost!");
           $('#registracijaLozinka').css('background-color','red');
           $('#registracijaLozinkaPotvrda').css('background-color','red');
           event.preventDefault();
           return;
       }
       else
       {
           $('#registracijaLozinka').css('background-color','white');
           $('#registracijaLozinkaPotvrda').css('background-color','white');
       }
       if(odabranaDrzava !== odabranaDrzavaPozivniBroj)
       {
            alert("Država mora odgovarati pozivnome broju!");
            $('#registracijaDrzava').css('background-color','red');
            event.preventDefault();
       }
       
    });
    
    function novaFunkcija()
    {
        $('#registracijaCheckbox').empty();
        var granica = index+10;
        $.getJSON('js/drzave-brojevi.json', function(data){
            for(var i = index; i < granica; i++)
            {
                $.each(data[i], function(key, val)
                   {
                       $('#registracijaCheckbox').append("<input type=checkbox class='registracijaCheckbox' id='" + key + "'> " + val + " " + key + "</input><br class=breakRegistracija>");
                   });

                index++;
            }
            $('#registracijaCheckbox').append("<button type='button' class='ucitajJosGumb'>" +"Ucitaj jos"+ "</button>");
        });
    }

//registracija - provjeravanje ispravnosti poruke putem RegEx-a

    $('#registracijaEmail').keyup(function(){
        var Email = $('#registracijaEmail').val();

        var regIzraz = new RegExp(/^([a-zA-Z0-9])+((\.)?)([a-zA-Z0-9]?)+(?=@)(@[a-zA-Z0-9]+)\.{1}([a-zA-Z0-9]{2,})$/);
        var regVelicinaIzraza = new RegExp(/^[a-z0-9.@]{10,30}$/);

        var izrazOk = regIzraz.test(Email);
        var velicinaOk = regVelicinaIzraza.test(Email);

        if(izrazOk && velicinaOk)
        {
            $('#registracijaEmail').css('background-color','white');
        }
        else
        {
            $('#registracijaEmail').css('background-color','red');
        }

    });

// provjeravanje postojanosti upisanog maila
    
    $('#registracijaEmail').focusout(function(){

        var Email = $('#registracijaEmail').val();
        var imeKorisnika, prezimeKorisnika, korisnickoImeKorisnika, dohvacenPodatak = false;

        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/2017/materijali/zadace/dz3/korisnikEmail.php',
            type: 'GET',
            data: {korisnik: Email},
            dataType: 'xml',
            success: function(Uspjeh){

                $(Uspjeh).find('korisnik').each(function(){
                    dohvacenPodatak = true;
                    imeKorisnika = $(this).find('ime').text();
                    prezimeKorisnika = $(this).find('prezime').text();
                    korisnickoImeKorisnika = $(this).attr('korime');
                });

                if(dohvacenPodatak == true)
                {
                    $('#registracijaIme').val(imeKorisnika);
                    $('#registracijaPrezime').val(prezimeKorisnika);
                    $('#registracijaKorisnickoIme').val(korisnickoImeKorisnika);
                }
                else
                {
                    $('#registracijaIme').removeAttr('disabled');
                    $('#registracijaPrezime').removeAttr('disabled');
                    $('#registracijaKorisnickoIme').removeAttr('disabled');
                }
            },
            error: function(Neuspjeh){
                alert("Neuspjeh" + Neuspjeh);
            }
        });

    });
    
    var drzave = new Array();
    $.getJSON("js/drzave.json", function(data){
        $.each(data, function(key, val){
            drzave.push(val); 
        });
    });

    $('#registracijaDrzava').autocomplete({
       source: drzave 
    });
    
    $(document).on('focusout', '#registracijaDrzava', slanjeDrzave);
    
    function slanjeDrzave()
    {
        
        var drzava = $('#registracijaDrzava').val();
        
        $.ajax({
            
            url: 'js/drzave.json',
            type: 'POST',
            data: { drzava },
            success: function(Uspjeh)
            {
                alert("Uspjesan prijenos");
            },
            error: function(Neuspjeh)
            {
                alert("Neuspjesan prijenos");
            }
        
        });
    }
    
    
    
    
    
    
    
    $('#slika1').click(uvecanjeSlike);
    $('#slika2').click(uvecanjeSlike);
    $('#slika3').click(uvecanjeSlike);
    $('#slika4').click(uvecanjeSlike);
    $('#slika5').click(uvecanjeSlike);
    $('#slika6').click(uvecanjeSlike);
    $('#slika7').click(uvecanjeSlike);
    $('#slika8').click(uvecanjeSlike);
    $('#slika9').click(uvecanjeSlike);
    $('#slika10').click(uvecanjeSlike);
    $('#slika11').click(uvecanjeSlike);
    $('#slika12').click(uvecanjeSlike);


    function uvecanjeSlike()
    {
        var idFigure = $(this).attr('id');
        var djecaFigure = $(this).children();
        var slika = djecaFigure[0];
        var slikaSRC = ($(slika).attr('src'));
        $('#ubacenaSlika').append("<img id='dodanaSlika' src='" + slikaSRC + "' alt=uvecanaSlika width=600 height=600 float='left'>");
        $('#ubacenaSlika').append("<img id='izlazak' src='multimedija/izlazak.png' alt='izlazak' width=15 height=15 float='right'>");
        
        $('#dodanaSlika').css('position', 'relative');
        $('#dodanaSlika').css('left', '400px');
        
        $('#izlazak').css('position', 'relative');
        $('#izlazak').css('bottom', '580px');
        $('#izlazak').css('left', '800px');
        
        $('.parentSlika').css('display','none');
        $('.videoYTGalerija').css('display','none');
        $('#headerGalerija').css('display','none');
        $('#navigacijaGalerija').css('display','none');
        $('#footerGalerija').css('display','none');
        $('#naslovGalerija').css('display','none');
    }


    $(document).on('click', '#izlazak', function(){
        
        $('#ubacenaSlika').empty();
        $('.parentSlika').css('display','');

        $('.videoYTGalerija').css('display','');
        $('#headerGalerija').css('display', '');
        $('#navigacijaGalerija').css('display', '');
        $('#footerGalerija').css('display','');
        $('#naslovGalerija').css('display','');
    }); 

    $('#tablicaTable').dataTable(
        {
            "aaSorting": [[0, "asc"]],
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true
    });
});