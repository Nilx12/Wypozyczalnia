
function saw(a,b,c,d)
{
	document.getElementById('t').innerHTML=a;
	document.getElementById('ro').innerHTML=b;
	document.getElementById('g').innerHTML=c;
	document.getElementById('r').innerHTML=d;
}
function ou()
{
		document.getElementById('t').innerHTML="";
	document.getElementById('ro').innerHTML="";
	document.getElementById('g').innerHTML="";
	document.getElementById('r').innerHTML="";
}
function newmovies()
{
    var nazwa="'#movnew'";
    var nu='<div id="movnew">';
    nu+='<div id="close"> Wypozyczenie filmowe <div class="clos1" onclick="x('+nazwa+');">x</div></div>';
    nu+='<form method="POST" action="library.php" enctype="multipart/form-data"><input type="hidden" name="true" value="t" />';
    nu+='<div id="topofmovie">'
    nu+=' <div class="kleintlef1"/>';
    nu+=' <input type="text" name="tytul" placeholder="Tytuł"/><br>';
    nu+='<select class="nosrez" name="gatunek" id="rega">';
       for(i=0; i<gatunek.length; i++)
    nu+='<option value="'+idgatu[i]+'">'+gatunek[i]+'</option>';
    nu+='</select><br>';
    nu+='<select class="nosrez" name="rezyser" id="rezy" onchange="rezysere(this.value)">';
    for(i=0; i<imion.length; i++)
        nu+='<option value="'+idr[i]+'">'+imion[i]+' '+nazwisk[i]+'</option>';
    nu+='<option value="new" >Nowy rezyser</option></select><br>';
    nu+='<select class="nosrez" name="nosnik"><option value="DvD">DvD</option><option value="Blue-ray">Blue-ray</option></select>';
        nu+='<input type="text" placeholder="Rok produkcji" name="rok"/><br>'; 
    nu+='<input type="text" name="cena" placeholder="cena" /><br>';
    nu+='<input type="text" name="kara" placeholder="kara" /><br>';
    nu+='</div>';
     nu+=' <div class="kleintright1"/>';
    nu+='<textarea id="opisywany" name="opistegi"> </textarea>';
    nu+='</div>'
    nu+='<div id="all">';
    nu+='<div id="nowyrezyser">';
    nu+='</div>';
    nu+='<div id="plakatyt">';
    nu+='</div>';
    nu+='</div>';
    nu+='<input type="file" class="spod" name="plakat">';
    nu+='<input type="submit" class="takei" value="Dodaj">';
    nu+='</form></div>';
    document.getElementById('container').innerHTML+=nu;
    rezysere('1');
}

function rezysere(x)
{
    var newre
    if(x=="new")
        {
            newre='<p class="titlerez">Rezysera</p>';
            newre+='<div class="kleintlef2">';
            newre+='<input type="text" name="imie"/><br>';
            newre+='<input type="text" name="nazwisko"/>';
            newre+='</div>';
            newre+='<div class="kleintright2">';
            newre+='Imie <br>';
            newre+='nazwisko';
            newre+='</div>';
        }
    else newre='<input type="hidden" value="'+x+'" name="idrez" />'
    
    document.getElementById('nowyrezyser').innerHTML=newre;
}