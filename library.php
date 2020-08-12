<?php
require_once 'classes.php';

$mov=new Movie($date);
$rezy=new Director($date);
$dic=new Dictionary($date);
$mar=new Ocena($date);
if(isset($_POST['true']))
    {
                
	if(isset($_FILES['plakat']))
    {
				$plakat=$mov->setPoster();
    }
     if(isset($_POST['nazwisko']))
     {
        $imie=$dic->setValue($_POST['imie'],'imie');
        $nazwisko=$dic->setValue($_POST['nazwisko'],'nazwisko');
        $rezyser=$rezy->createDirector($imie,$nazwisko);
         
     } else
        $rezyser=$_POST['idrez'];
    $nosnik=$dic->setValue($_POST['nosnik'],'nosnik');
    $opis= htmlentities($_POST['opistegi'], ENT_QUOTES, "UTF-8");
    $tytul= htmlentities($_POST['tytul'], ENT_QUOTES, "UTF-8");
    $nowyfilm=$mov->createMovie($tytul,$rezyser,$_POST['rok'],$_POST['gatunek'],$opis,$_POST['cena'],$_POST['kara'],$nosnik,$plakat);
     
}

    if(isset($_POST['wyszuf'])){
	   $mov->wyszukiwanie( $_POST['wyszukajpo'],$_POST['wyszuf']);
    }
    $mov->setConditions('limit','52');
	$numb=$mov->getLibrary();

    $rezyser=$rezy->getLibrary();

    $gatunek=$dic->getLibrary('gatunek');
?>

<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/style.css">

	<link rel="shortcut icon" href="grafiki/dvd.jpg">
    <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>

<script type="text/javascript">
        var nazwisk=<?php echo json_encode($rezyser['nazwisko']) ?>;
       var imion=<?php echo json_encode($rezyser['imie']) ?>;
       var idr=<?php echo json_encode($rezyser['id']) ?>;
        var idgatu=<?php echo json_encode($gatunek['id']) ?>;
       var gatunek=<?php echo json_encode($gatunek['gatunek'])?>;
        </script>
    </head>
	<body>
                    <div id="about">
               <div id="strza"> <select id="poczym" onclick="switchArrow()" >
                    <option value="tytul">Tytul</option>
                    <option value="rezyser">Rezyser</option>
                    <option value="rok">Rok produkcji</option>
                </select>  <img class="str" src="grafiki/ad.png" >   </div>
              <div id="inputsearch">  <input type="text" placeholder="Wyszukaj" id="wyszuf"> <img class="sicon" src="grafiki/icons.png" ></div>
            </div>
            <div id="menu">
                <nav>
                    <ul id="menlist">
                        <li>Glowna</li>
                        <li>Biblioteka</li>
                        <li>Ranking</li>
                        <li>O firmie</li>
                        
                        
                        
                    </ul>
                </nav>
            </div>
            <div id="container">  
                
                <div class='forur'>
            <?php  $it=0; 
                foreach($numb as $f){
                $oc=$f['ocena'];
                $star=$mar->getStarByMark($oc);
                $plakat=$f['url'];
                $tyt=$f['tytul'];
                if($it>0 && $it%4==0) echo "</div><div class='forur'>";
                echo"<div class='filmik'>";
                echo"<a href='film.php?tytul=$tyt'><img class='posterfilm' src='plakaty/$plakat'></a>";
                echo"<a href='star.php' title='$star'><img class='star' src='grafiki/$star.png'></a>";
                echo"</div>";
                    
                    
                $it++;
                }

              ?>  
                </div>
              
            </div>
            <script type="text/javascript">
                tru=true;
                function switchArrow(){
                    if(tru){ tru=false;
                    $('.str').css('transform','rotate(180deg)'); }
                    else {
                        $('.str').css('transform','rotate(0deg)'); tru=true;
                    }
                }
                     
             </script>   
    </body>    
</html>