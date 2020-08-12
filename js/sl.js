var active;
var nev;
setTimeout(function fr(){

	
$(".part").css("display", "none");


active="#"+document.getElementById('jejsel').value;

	$(active).css("display", "block");

	nev='<div id="windown"><div class="clos" onclick="xc()">X</div><form name="fo1" method="post" action="slowniki.php"><input type="text" id="val" name="val"/><input type="hidden" name="se" id="se" value="'+document.getElementById('jejsel').value+'"><input type="submit" value="wyśłij"/></form></div>';	

$("#dod").on('click',function (){document.getElementById("container").innerHTML+=nev; })

},0);


function fu(c)
{
	var v="#"+c;
	$(active).css("display", "none");
	$(v).css("display", "block");
	nev='<div id="windown"><div class="clos" onclick="x()">X</div><form name="fo1" method="POST" action="slowniki.php"><input type="text" name="val" id="val"/><input type="hidden" name="se" id="se" value="'+c+'"><input type="submit" value="wyśłij"/></form></div>';	
	active=v;
	$("#dod").on('click',function (){ document.getElementById("container").innerHTML+=nev; });
}

