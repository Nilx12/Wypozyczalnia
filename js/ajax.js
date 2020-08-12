var was=false;
var boole=false;
function ser()
{
   
    if(was==false){
    $('.star1').css('display','none');
     var newers='';
            for(i=1; i<=6; i++)
        {
            var id="bs"+i;
            newers+='<img class="blackstar" src="grafiki/black.png" id="'+id+'" onMouseOver="gwiazd('+i+');">';
            
        }
   if (boole==false) {document.getElementById("ocena_kontener").innerHTML+=newers;
                    boole=true;
    
 
   
        $("#bs1").on("click",function(){send(1);});
        $("#bs2").on("click",function(){send(2);});
        $("#bs3").on("click",function(){send(3);});
        $("#bs4").on("click",function(){send(4);});
        $("#bs5").on("click",function(){send(5);});
        $("#bs6").on("click",function(){send(6);});
       
    
            }
}}
function ser1()
{
     $('.blackstar').remove();
    $('.star1').css('display','inline-block');
    boole=false;
    
}

function gwiazd(x)
{ 
    for(i=1; i<=x; i++)
        {
            $("#bs"+i).attr("src", "grafiki/gold.png");
        }
}

function send(xree)
{ console.log(idk+" "+xree);
    if(xree<=6 && xree>0){
    $.ajax({
            type:"POST", 
            url:"ajaxo.php",
            data: {klucz_ajax:xree,idk:idk},
        
        success:function() {
            was=true;
        },
        });
}}
$("#lelk").live("click",function(){
   var newser;
    nzz="'#editmovie'";
    newser='<div id="editmovie">';
    newser+='<div id="close"><div class="clos1" onclick="x('+nzz+');">x</div></div>';
    newser+='<form id="todzi" method="POST" action="film.php?tytul='+tytluas+'" enctype="multipart/form-data">';
    newser+='<div id="imagenew">';
    newser+='<input type="file" id="plik" class="spod" name="plakat" />';
    newser+='</div>';
    newser+='<div id="opisnew">';
    newser+='<textarea name="opistegi" id="opistegi" form="todzi"></textarea>';
    newser+='<input type="submit" value="zatwierdz">';
    newser+='</div>';
    newser+='<div id="aboutnew">';
        newser+='<select class="nosrez" name="rezyser" id="rezy" onchange="rezysere(this.value)">';
    for(i=0; i<imion.length; i++)
        newser+='<option value="'+idr[i]+'">'+imion[i]+' '+nazwisk[i]+'</option>';
    newser+='<option value="new" >Nowy rezyser</option></select><br>';
    newser+='<input type="text" name="rok" placeholder="rok produkcji"><br>';
        newser+='<select class="nosrez" name="gatunek" id="rega">';
    for(i=0; i<gatunek.length; i++)
        newser+='<option value="'+idgatu[i]+'">'+gatunek[i]+'</option>';
    newser+='</select><br>';
    newser+='<input type="text" name="cena" placeholder="cena"><br>';
    newser+='<input type="text" name="kara" placeholder="kara"><br>';
    newser+='<input type="text" name="czas" placeholder="czas trwania"><br>';
    newser+='<input type="text" name="kraj" placeholder="kraj Produkcji"><br>';
    newser+='<input type="hidden" name="idek" value="'+idf+'">';
    newser+='</div>';
    newser+='</form>'
    newser+='</div>';
     document.getElementById('container').innerHTML+=newser;
});

