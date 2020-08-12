function edytujklienta(klientx)
{
    nazwakli='edytklient';
    nowk='<div id="edytklient">';
    nowk+='<div id="close">Dodwanie nowego klienta <div class="clos1" onclick="x('+nazwakli+');">x</div></div>';
    nowk+='<form action="klienci.php" method="post"><br>';
    nowk+='<input type="text" class="skli" name="imiee" placeholder="Imie"/><br>';
    nowk+='<input type="text" class="skli" name="nazwiskoe" placeholder="Nazwisko"/><br>';
    nowk+='<input type="text" class="skli" name="miastoe" placeholder="Miasto"/><br>';
    nowk+='<input type="text" class="skli" name="ulicae" placeholder="Ulica"/><br>';
    nowk+='<input type="text" class="skli" name="kodpocze" placeholder="Kod pocztowy"/><br>';
    nowk+='<input type="text" class="skli" name="nrdome" placeholder="Numer domu" />';
    nowk+='<input type="submit" class="skli2" name="edytuje" value="zapisz zmiany" />';
    nowk+='<input type="hidden" value="'+klientx+'" name="idklienta"/>';
    nowk+='</form>';
    nowk+='</div>';
     document.getElementById('container').innerHTML+=nowk;
}

function addclient()
{
    var naz="'#newclient'";
    var nc='<div id="newclient">';
    nc+='<div id="close">Dodwanie nowego klienta <div class="clos1" onclick="x('+naz+');">x</div></div>';
    nc+='<div id="aboutclient">';
    nc+='<form method="POST" action="klienci.php">';
    nc+='<div class="kleintlef">';
    nc+='<input type="text" name="imie"/><br>';
    nc+='<input type="text" " name="nazwisko"/><br>';
    nc+='<input type="text"  name="miasto"/><br>';
    nc+='<input type="text"  name="ulica"/><br>';
    nc+='<input type="text"name="kodp"/><br>';
    nc+='<input type="text"  name="nrd"/><br>';
     nc+='</div>';
    nc+='<div class="kleintright">';
    nc+='imie:<br>'
    nc+='Nazwisko:<br>'
    nc+='Miasto:<br>'
    nc+='Ulica:<br>'
    nc+='Kod Pocztowy:<br>'
    nc+='Numer domu:'
    nc+='</div>';
       nc+='<input type="submit" class="dodbutton" value="Dodaj klienta"/>';
    nc+='</form>';
    nc+='</div>';
    nc+='</div>'; 
    
    
    document.getElementById('container').innerHTML+=nc;
}