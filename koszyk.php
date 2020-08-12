<?php
require_once 'classes.php';
$koszyk=new Koszyk($date);
$zaw=$koszyk->getKoszykByUser($_SESSION['user']);
?>

<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/second.css">
        <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>
	</head>
	<body>
		<main>
		<div id="menu"><nav>
			<ul id="meniu">
                <li> <a href="index.php">Strona główna</a> </li>
                <li> <a href="library.php">Biblioteka filmów</a></li>
                
                               <?php if( isset($_SESSION['tryb']) && $_SESSION['tryb']>=2){
echo<<<Ebd
                <li><a href="klienci.php">Lista klientów</a></li>
                <li><a href="wyplist.php">Wypożyczenia</a></li>
Ebd;
} else            
           ?> 
            </ul>
                            <?php
             if(isset( $_SESSION['log']) && $_SESSION['log']==true)
             { $n=$_SESSION['nick'];
                 echo"<div id='allof'>";
                 echo"<div id='woz'><img id='zak' src='grafiki/woz.png'></div>";
                 echo"<div id='nick'><a href='logout.php' class='zalog' >$n</a></div>";
                echo"</div>"; 
             } else {           echo"<div id='allof'>";
                 echo "<a href='logowanie.php' class='zalog'>zaloguj</a>";
                echo"</div>"; 
                    }
            ?>
		</nav>
   
            </div>
				
			<div id="container">
                <div id="koszyk">
                    <?php $iteral=0; $valu=Array();
                        foreach($zaw as $value){ 
                            $v=$value['tytul'];
                            $re=$value['imiona']."  ".$value['nazwiska'];
                            $c=$value['url'];
                            $kosz=$value['id_koszyk'];
                            $valu[$iteral]=$value['id_film'];
echo<<<END
                            <div class="valueofit">
                            <div class="imgpic">
                                <img class="pbraztegoid" src='plakaty/$c' >
                            </div>
                            
                            <div class="texts"> 
                                <p class="title">$v</p>
                                <p class="rez">$re</p>
                                <button id="ub" onclick="ajaxRemoveButton($valu[$iteral],$kosz)" >Remove</button>
        
                            </div>
                            
                            </div>
END;
                        $iteral++;}
                    ?>
                
                    <button id="cler" onclick="clearIt(<?php echo$kosz?>)">Wyczysc</button>
                    <button id="cler" onclick="ajaxBuy()">zakup</button>
                </div>
	
			</div>
		</main>
            <script type="text/javascript">
               function ajaxRemoveButton(id,koszyk){
                    $.ajax({
            type:"POST", 
            url:"prun.php?mode=remove",
            data: {film:id,koszyk:koszyk},
            success: function() {
            location.reload();
        },
       
        });
                   
               }
               
        function clearIt(kosz){
                                $.ajax({
            type:"POST", 
            url:"prun.php?mode=clear",
            success: function() {
            location.reload();
        },
       
        });   
        }
       function ajaxBuy(){
           $.ajax({
            type:"POST", 
            url:"prun.php?mode=buy",
            data:{tabelaall:<?php echo json_encode($valu)?>},
            success: function(t) {
            location.reload();
        },
       
        });
           
       }   
            </script>

	</body>
</html>