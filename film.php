<?php
require_once 'classes.php';
$oceniles=true;
header('Content-Type: text/html; charset=utf-8');
$kom=new Komentarz($date);
$movie=new Movie($date);
$koszyk=new Koszyk($date);

if(isset($_SESSION['user']))$kosz=$koszyk->getKoszykId($_SESSION['user']);
if(isset($_POST['rok']))
    {$nosnik=1; $plakat=0;
    if(isset($_FILES['plakat']['tmp_name']))
    $plakat=$movie->setPoster();


     $movie->updateMovie($_POST['rezyser'],$_POST['rok'],$_POST['gatunek'],$_POST['cena'],$_POST['kara'],$_POST['opistegi'],$nosnik,$plakat,$_POST['idek']);

    }
if(isset($_GET['tytul']))
    {
      $film="'".$_GET['tytul']."'";  
    } else
        {
       $film='"Shrek"';
       }

    $otym=$movie->getMovies($film);
    $plakat=$otym['url'];
    $tytult=$otym['tytul'];
    $opis=$otym['opis'];
    $imie=$otym['imiona'];
    $naz=$otym['nazwiska'];
    $rok=$otym['Rok_produkcji'];
    $gat=$otym['gatunek'];
    $idfilmu=$otym['id'];
$kom->setSqlWhere($idfilmu,'content');
$koments=$kom->getComment();


     $ocena=new Ocena($date);
if(isset($_SESSION['log'])) 
    {   
         $work=$_SESSION['user'];
         $mark=$ocena->getOcenaByUser($work,$idfilmu);
         $oceniles=$ocena->isMarked($work,$idfilmu);
    }
$di=new Dictionary($date);
$gatunek=$di->getLibrary('gatunek');
$ocenakon=$ocena->getMarkByMovie($idfilmu);
$rezy=new Director($date);
$rezyser=$rezy->getLibrary();
?>
<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="shortcut icon" href="grafiki/dvd.jpg">
        
	<link rel="stylesheet" href="css/style.css">
            <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>
	</head>
	<body>
        
    <script type="text/javascript">
    
        idk=<?php echo $idfilmu ?>;
    </script>    
	
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
                
                <div id="contfilm"><img id="plakatfilm" src="plakaty/<?php echo$plakat ?>">
                <?php 
    
                        if($ocenakon>=3){
                        $star=$ocena->getStarByMark($ocenakon);
                        
                        echo"<img class='star' src='grafiki/$star.png'>";

                        
                        }
                    ?>
                
                </div>
                <div id="bigofit">
                    <div id="tytul"> <?php echo "$tytult ($rok) "?> </div>
                    <div id="opis"> <?php echo "$opis "?> </div>
                    
                </div>
                
                <div id="info">

                    <div id="mark">
                    
                  <div id="ocena_kontener" <?php if(!$oceniles) echo"onMouseOver='ser();' onmouseout='ser1();'"; ?> >
                                 <?php
                                 
                                 
                                    for($i=1; $i<=6; $i++)
                                    {
                                         if($i<=$ocenakon)
                                        echo "<img class='star1' src='grafiki/gold.png'>";
                                     if($i>$ocenakon && $i-1<$ocenakon)
                                        echo "<img class='star1' src='grafiki/silver1.png'>";
                                        else if($i>$ocenakon)
                                            echo "<img class='star1' src='grafiki/black.png'>";
                                    
                                    } 
                                 
                                 
                                 ?>
                      </div>
                    <p class="marek"> <?php  echo"$ocenakon / 6"; ?> </p>
                    </div>
                    <p class="in">Dyrekcja: <?php echo" $imie $naz" ?></p>
                    <p class="in">Gatunek: <?php echo" $gat" ?></p>

                </div>
                
                <div id="coments">
                        <?php
                            foreach($koments as $value)
                            {   $oc=$value['ocena'];
                                $us=$value['login'];
                                $tre=$value['komentaz'];
                                $idkom=$value['id'];
                                $o=$value['oc'];
                                $id=$value['id'];
                                echo"<div class='coment' id='$id' onmouseover=lol(this.id)>";
                                echo "<div class='prof'> <p class='nic'>$us</p> <p class='ocen' >$oc/6 </p>";
                                echo"<div class='lapki'>";
                                echo"<img class='thumb' class='down' src='grafiki/indeks.png'>$o";
                                echo"<img class='thumb' class='up' src='grafiki/indeks1.png'>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='tresc'>$tre</div>";
                                echo"</div>";
                            }
                            
                        ?>
                    
                </div>
                
	
			</div>

        <script type="text/javascript" src="js/functions.js"></script>
        	<script type="text/javascript" src="js/ajax.js"></script>
        	<script type="text/javascript" src="js/comments.js"></script>
                <script type="text/javascript">
var valu=0;
                    
                    
       function lol(x) {
           valu=x;
           console.log(valu);
           
       }            
                    
         function dodajdo(koszyk,film){
                        $.ajax({
            type:"POST", 
            url:"prun.php?mode=add&code=koszyk",
            data: {kom:valu,koszyk:koszyk},
            success: function() {
            alert('dodano');
        },
       
        });
}   
       
                       var tru=true;
                function switchArrow(){
                    if(tru){ tru=false;
                    $('.str').css('transform','rotate(180deg)'); }
                    else {
                        $('.str').css('transform','rotate(0deg)'); tru=true;
                    }
                }
           $('.down').on('click',function(){
                   
                   
                   $.ajax({
            type:"POST", 
            url:"prun.php?mode=dislike&code=lid",
            data: {kom:valu,ocena:'-1'},
            success: function() {
            alert('dodano');
        },
       
        });
                   
                   
           }   );  
                    
           $('.up').on('click',function(){
                   
                   
                   $.ajax({
            type:"POST", 
            url:"prun.php?mode=dislike&code=lid",
            data: {kom:valu,ocena:'+1'},
            success: function() {
            alert('dodano');
        },
       
        });
                   
                   
           }  );
                    </script>

	</body>
</html>