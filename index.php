<?php
require_once 'classes.php';


$filmek=new Movie($date);
$mark=new Ocena($date);
$filmek->setOrder('desc');
$filmek->setConditions('limit','4');
$numb=$filmek->getLibrary();
?>

<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="grafiki/dvd.jpg">
        <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>
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
            
                
                <div id="lastfive">
                    <?php
                          foreach($numb as $n){
                              $np=$n['url'];
                             $oc=$mark->getMarkByMovie($n['id']);
                             
                             $star=$mark->getStarByMark($oc);
echo<<<END
                        <div class="pst"> <img class="poster" src="plakaty/$np"> 
END;
if($oc>=3)echo"<img class='star' src='grafiki/$star.png'>";
echo"</div>";

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