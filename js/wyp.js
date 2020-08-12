var ilosc=0;
var filmy=new Array();
function newyp()
{
    var newe='<div id="newyp">';
    var nazw="'#newyp'";
    newe+='<div id="close"><div class="clos1" onclick="x('+nazw+');">x</div></div>';
     newe+='<form action="wyplist.php" method="post"><input type="hidden" name="true" value="t">';
    newe+='<div id="lwyp">';
    newe+='<div id="topfil">';
    newe+='Data wypożyczenia: <input type="text" name="d1" placeholder="rrrr-dd-mm"><br>';
    newe+='Data zwrotu: <input type="text" name="d2" placeholder="rrrr-dd-mm"><br>';
    newe+='<select name="films" id="filmse">';
    for (i=0; i<movies.length; i++)
    newe+='<option value="'+i+'">'+movies[i]+'</option>'; 
    newe+='</select><div id="button" onclick="addmovie()">Dodaj</div>';
    newe+='</div>';
    newe+='<div id="films"><input type="hidden" name="filmy" id="fff"/>';
    
    
    newe+='</div>';
    newe+='</div>';
    newe+='<div id="lkli"><select id="s" name="fere" onchange="fer()">'
    for(i=0; i<idk.length;i++)
        newe+='<option value="'+i+'">'+imiona[i]+" "+ nazwiska[i]+'</option>';
    newe+='<option value="nowy">Nowy klient</option></select>';
    newe+='<div id="daneklienta">'
    
   
    newe+='</div>'
    newe+='</div>'
    newe+='<input type="submit" value="Dodaj wypozyczenie"/>'
    newe+='</form>'
    newe+='</div>';
    document.getElementById('container').innerHTML+=newe;
 fer();
}


function addmovie()
{
    var a=document.getElementById("films").value;
    var addnew='<img src="plakaty/'+plakaty[parseInt(document.getElementById('filmse').value)]+'" class="thumbnail" name="'+ilosc+'" onclick="remove(this.id, '+ilosc+')" id="'+mid[parseInt(document.getElementById('filmse').value)]+'">';
    filmy[ilosc]=mid[parseInt(document.getElementById('filmse').value)];
    ilosc++;
    document.getElementById('films').innerHTML+=addnew;
    document.getElementById('fff').value=filmy;
}
function remove(s,f)
{
    s="#"+s;
   $(s).remove(); 
filmy[parseInt(f)]=null;
    document.getElementById('fff').value=filmy;
}

function fer()
{
    var anewe;
        if(document.getElementById('s').value!="nowy")
            {
        anewe='<p class="danek" id="imiekli">' +imiona[parseInt(document.getElementById('s').value)] +'</p>';
        anewe+='<p class="danek" id="nazwkl">' +nazwiska[parseInt(document.getElementById('s').value)] +'</p>';
        anewe+='<p class="danek" id="miastkl">' +miasta[parseInt(document.getElementById('s').value)] +'</p>';
        anewe+='<p class="danek" id="ulicakl">' +ulice[parseInt(document.getElementById('s').value)] +'</p>';
         anewe+='<input type="hidden" name="ses" value="'+idk[parseInt(document.getElementById('s').value)]+'">'       
            }
        else
        {
            anewe='<div class="kleintlef3">';
            anewe+='<input type="text" name="imie"/><br>';  
            anewe+=' <input type="text" name="nazwisko"/><br>';  
            anewe+='<input type="text" name="miasto"/><br>';  
            anewe+='<input type="text" name="ulica"/><br>';  
            anewe+='<input type="text" name="kodp"/><br>';  
            anewe+='<input type="text" name="nrd"/>';
            anewe+='</div>';
            anewe+='<div class="kleintright2">';
            anewe+='imie:<br>'
            anewe+='Nazwisko:<br>'
            anewe+='Miasto:<br>'
            anewe+='Ulica:<br>'
            anewe+='Kod Pocztowy:<br>'
            anewe+='Numer domu:'
            anewe+='</div>';


        }
    document.getElementById('daneklienta').innerHTML=anewe;
}
function zwrot(f)
{
    var bowe='<div id="update">';
    bowe+='<div id="close"><div class="clos1" onclick="x2();">x</div></div>';
    bowe+='<form method="POST" action="wyplist.php">';
    bowe+='<input type="text" name="tak"/>';
    bowe+='<input type="hidden" name="wypp" value="'+f+'"/>';
    bowe+='<input type="submit" values="wyślij"/>';
    bowe+='</form></div>';
    document.getElementById('container').innerHTML+=bowe;
}
