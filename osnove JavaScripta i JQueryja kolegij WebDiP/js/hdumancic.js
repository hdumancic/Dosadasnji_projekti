// 6. funckionalnost - kolačići
// ime funkcije - PostojanjeKolacica()
window.addEventListener("load", PostojanjeKolacica());

function PostojanjeKolacica()
{
    kolacic = document.cookie;
    if(kolacic.length === 0)
    {
        document.cookie = "prvi dolazak; expires=Mon";
        alert("Ova stranica sprema kolačiće");
    }


    //svojstvo inputa na temelju browsera
    // 4. funckionalnost
    imeBrowsera = navigator.userAgent;
    if(imeBrowsera.includes("Firefox"))
    {
        document.getElementById("datumOdabira").type = "text";
        document.getElementById("datumOdabira").placeholder = "DD-MM-YYYY";
    }
    else
    {
        document.getElementById("datumOdabira").type = "date";
    }
}


// 1. funkcionalnost - Provjera ispunjenosti tekstualnih elemenata i provjera nedozvoljenih znakova
// ime funkcije - ProvjeraIspunjenostiPredSlanje()
// 7. funkcionalnost - Ispisivanje prenesenih vrijednosti u novome prozoru

window.addEventListener("submit", function(event){

    poljeTekstualnihPodataka = [window.document.getElementById("odabraniKlubIzbor"), window.document.getElementById("odabraniKlubOpis")];
    bezTeksta = false;
    nedozvoljenZnak = false;

    for(i = 0; i < poljeTekstualnihPodataka.length; i++)
    {
            if(poljeTekstualnihPodataka[i].value == "" || poljeTekstualnihPodataka[i].value == null)
            {
                bezTeksta = true;
                break;
            }
            var uneseniPodatak = poljeTekstualnihPodataka[i].value;
            for(k = 0; k < uneseniPodatak.length; k++)
            {
                if(uneseniPodatak[k] === "?" || uneseniPodatak[k] === "!" || uneseniPodatak[k] === "#" || uneseniPodatak[k] === "'")
                {
                    nedozvoljenZnak = true;
                    break;
                }
            }
    }
    if( bezTeksta === true)
    {
        alert("Prazno neko od polja!");
        event.preventDefault();
    }

    if(nedozvoljenZnak === true)
    {
        alert("Nedozvoljen znak");
        event.preventDefault();
    }

    //Sedma funkcionalnost - Otvaranje prenesenih vrijednosti u novom prozoru

    if(bezTeksta === false && nedozvoljenZnak === false)
    {
        poljaUnesenihPodataka = [window.document.getElementsByTagName("input"), window.document.getElementsByTagName("textarea"), window.document.getElementsByTagName("select")];
        window2 = window.open("", "Prozor_prenesene_vrijednosti", "scrollbars=no, width=500, height=500");

        for(i = 0; i < poljaUnesenihPodataka.length; i++)
        {
            for(j = 0; j < poljaUnesenihPodataka[i].length; j++)
            {
                if(poljaUnesenihPodataka[i][j].value !== "Pošalji")
                    window2.document.write(poljaUnesenihPodataka[i][j].name + ":        "  + poljaUnesenihPodataka[i][j].value + "<br>");
            }
        }   
    }   
});

//Druga funkcionalnost - Provjera valjanosti upisa u datalist (postojanost tima)

odabraniTim = document.getElementById("odabraniKlubIzbor");
listaTimova = document.getElementById("odabraniKlub").childNodes;

window.document.getElementById("odabraniKlubIzbor").addEventListener("keyup", function(){
    ispravanUnos = false;

    for(i = 0; i < listaTimova.length; i++)
    {
        if(odabraniTim.value === listaTimova[i].value)
        {
            ispravanUnos = true;
        }
    }

    if(ispravanUnos === false)
    {
        odabraniTim.style.backgroundColor = "red";
    }else
    {
        odabraniTim.style.backgroundColor = "green";
    }
});


//Treca funkcionalnost - Provjera višelinijskog upisa (manje od 5 znakova i veliko početno slovo);

viselinijskiUnos = document.getElementById("odabraniKlubOpis");

window.document.getElementById("odabraniKlubOpis").addEventListener("focusout", function(){

   if(viselinijskiUnos.value.length < 5)
   {
       alert("Višelinijski tekstualni element mora imati najmanje 5 znakova!");
   }

   if(viselinijskiUnos.value.length > 0)
   {
       prvoSlovo = viselinijskiUnos.value[0];
       if(prvoSlovo !== prvoSlovo.toUpperCase())
       {
           alert("Prvo slovo mora biti veliko!");
       }
   }
});

//Peta functionalnost - ako je broj izmedu 1 i 10 prikazi klizač

odabraniBroj = document.getElementById("odabraniBroj");

odabraniBroj.addEventListener("focusout", function(){

    if(odabraniBroj.value >= 1 && odabraniBroj.value <= 10)
    {
        dodajKlizac = document.getElementById("dodajKlizac");
        dodajKlizac.style.display = "block";
        odabirVisine = document.getElementById("odabirVisine");
        odabirVisine.value = odabraniBroj.value;
    }
    else
    {
        dodajKlizac.style.display = "none";
        odabraniBroj = document.getElementById("odabraniBroj");
        odabirVisine = document.getElementById("odabirVisine");
        odabirVisine.value = odabraniBroj.value;
    }
});
