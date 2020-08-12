<?php
require_once 'classes.php';


$filmek=new Movie($date);
$mark=new Ocena($date);
    if(isset($_POST['wyszuf'])){
	   $mov->wyszukiwanie( $_POST['wyszukajpo'],$_POST['wyszuf']);
    }
    $filmek->setOrder('desc','ocena');
    $filmek->setConditions('limit','100');
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
            
                <div id="mainrank">
                    <?php
                    $iteral=1;
                        foreach($numb as $value){
                            $im=$value['url'];
                            $tyt=$value['tytul']." (".$value['rok_produkcji'].")";

                            echo"<div class='rankposiiton'>";
                                echo"<div class='grara'><img src='grafiki/gold.png' class='staroftop'> <p class='poftop'><b>$iteral</b></p></div>";
                                echo"<img class='posteroftop' src='plakaty/$im'>";
                       
                        $iteral++;
                            $ocenakon=round($value['ocena'],1);
                            
                            echo "<div id='heis'>";
                            echo "<div class='tytultop'> <p>$tyt</p></div>";
                           
                            
                            echo "<div id='stars'>";
                                                                 
                                   for($i=1; $i<=6; $i++)
                                    {
                                         if($i<=$ocenakon)
                                        echo "<img class='startt' src='grafiki/gold.png'>";
                                     if($i>$ocenakon && $i-1<$ocenakon)
                                        echo "<img class='startt' src='grafiki/silver1.png'>";
                                        else if($i>$ocenakon)
                                            echo "<img class='startt' src='grafiki/black.png'>";
                                    
                                    } echo "$ocenakon/6";
                            echo"</div>";
                              echo"</div>";
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