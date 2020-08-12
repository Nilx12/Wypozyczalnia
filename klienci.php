<?php
require_once 'classes.php';

$clint=new Klient($date);
$dict=new Dictionary($date);

if( !isset($_SESSION['tryb']) || $_SESSION['tryb']<2)
{
    header('location:index.php');
    $_SESSION['permision']="Nie masz uprawnień do przeglądania tej strony!";
	exit();
}
if(isset($_POST['imiee']))
{            $newimie='';
            $newimie=$dict->setValue($_POST['imiee'],'imie');
            $newzaz='';
            $newzaz=$dict->setValue($_POST['nazwiskoe'],'nazwisko');
            $newmiasto='';
            $newmiasto=$dict->setValue($_POST['miastoe'],'miasto');
            $nowul='';
            $nowul=$dict->setValue($_POST['ulicae'],'ulica');
            $klient=$clint->updateKlient($newimie,$newzaz,$newmiasto,$nowul,$_POST['kodpocze'],$_POST['nrdome'],$_POST['idklienta']);
}

  if(isset($_POST['imie'])) { 
$imie=$dict->setValue($_POST['imie'],'imie');
$nazw=$dict->setValue($_POST['nazwisko'],'nazwisko');
$mias=$dict->setValue($_POST['miasto'],'miasto');
$ul=$dict->setValue($_POST['ulica'],'ulica');        
$clint->createClient($imie,$nazw,$mias,$ul,$_POST['kodp'],$_POST['nrd']);
  }


if(isset($_POST['wyszuk']))
    $clint->wyszukiwanie($_POST['seleckli'],$_POST['wyszuk']);   

    $numb=$clint->getLibrary();   
?>
<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/second.css">
	<link rel="shortcut icon" href="grafiki/dvd.jpg">
    <script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>
            <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/klient.js"></script>


	
	</head>
	<body>

		<main>
				<div id="menu"><nav>
			<ul id="meniu">
                <li> <a href="index.php">Strona główna</a> </li>
                <li> <a href="library.php">Biblioteka filmów</a></li>
                <li><a href="klienci.php">Lista klientów</a></li>
                <li><a href="wyplist.php">Wypożyczenia</a></li>
            </ul>
                            <?php
             if(isset( $_SESSION['log']) && $_SESSION['log']==true)
             { $n=$_SESSION['nick'];
                 echo"<div id='allof'>";
                 echo"<div id='woz'><img id='zak' src='grafiki/woz.png'></div>";
                 echo"<div id='nick'><a href='logout.php' class='zalog' >$n</a></div>";
                echo"</div>"; 
             } else {           echo"<div id='allof'>";
                 echo "<a href='logowanie.php' class='zalog' >zaloguj</a>";
                echo"</div>"; 
                    }
            ?>
		</nav>
   
            </div>
				
			<div id="container">
                     <?php
       if(isset($validate)) 
       if($validate==false){ 
echo<<<end
            <div id="error"><div id="close">Error<div class="clos1" onclick="x('#error');">x</div></div>
end;
                echo"<ul>";
    for($i=0; $i<count($error); $i++)
    echo"<li>$error[$i]</li>";

echo'</ul>';
echo'</div>';
        
       }
        ?>
			<div id="strr">
			<div id="sea"><div id="search"><form method="POST" action="klienci.php"><input id="searchin" typ="text" name="wyszuk" placeholder="wyszukiwanie"/>
                <select class="klasa" name="seleckli">
                    <option value="imie">Imie</option>
                    <option value="nazwisko">Nazwisko</option>
                    <option value="miasto">Miasto</option>
                    <option value="ulica">Ulica</option>
                </select>
                <input class="klasa" type="submit" value="wyszukaj">
                </form></div>
                <p id="asw"><b>klienci</b></p><button id="dk" onclick="addclient()">dodaj Klienta</button></div>
			<div class="star">
<?php
$ik=0;

foreach($numb as $numb1){
if($ik%3==0 && $ik!=0)echo '</div> <div class="star">'; 
$d[0]=$numb1['imiona'];
$d[1]=$numb1['nazwiska'];
$d[2]=$numb1['miasto'];
$d[3]=$numb1['ulice'];
$d[4]=$numb1['kod_pocztowy'];
$d[5]=$numb1['numer_domu'];
$de=$numb1['id_kl'];
$ik++;
echo<<<END

<div class="klient">
Klient: $d[0]
$d[1]<br>
 $d[2]<br>
$d[3]
$d[5]<br>
$d[4]

    
       <button class='edyklient' onclick='edytujklienta($de)'>E</button>
    
</div>   
END;
}




		?>	
                </div></div></div>
		</main>
          
	</body>
</html>