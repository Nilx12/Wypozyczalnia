<?php
require_once 'classes.php';
$user=new Klient($date);

if( !isset($_SESSION['tryb']) || $_SESSION['tryb']<2)
{
    header('location:index.php');
     $_SESSION['permision']="Nie masz uprawnień do przeglądania tej strony!";
	exit();
}
    $validate=true;
    $error=[];
    $ilosc=0;
if(isset($_POST['tak']))
{
    
    if(strlen($_POST['tak'])!=10 || substr($_POST['tak'],4,1)!="-" || substr($_POST['tak'],7,1)!="-" )
    {
    $validate=false;
    $error[$ilosc]="błedna data!";
    $ilosc++;
    }
    if($validate){
    $up=$date->prepare('update wypozyczenia Set data_odd=:cr where id=:ce');
    $up->bindValue(':cr', htmlentities($_POST['tak'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
    $up->bindValue(':ce', htmlentities($_POST['wypp'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
    $up->execute();
    }
}

    if(isset($_POST['true']))
    { 
        

        $klient;
        $wypozyczenie;
	   
       if(isset($_POST['imie'])){ 
            if(strlen($_POST['imie'])<3 || strlen($_POST['imie'])>50)
      {
          $validate=false;
          $error[$ilosc]="Błędnie podane imie";
          $ilosc++;
      }
            if(strlen($_POST['nazwisko'])<3 || strlen($_POST['nazwisko'])>50)
      {
          $validate=false;
          $error[$ilosc]="Błędnie podane nazwisko";
          $ilosc++;
      }
                  if(strlen($_POST['miasto'])<3 || strlen($_POST['miasto'])>50)
      {
          $validate=false;
          $error[$ilosc]="Błędnie podane miasto";
          $ilosc++;
      }
        if(strlen($_POST['ulica'])<3 || strlen($_POST['ulica'])>50)
      {
          $validate=false;
          $error[$ilosc]="Błędnie podana Ulica";
          $ilosc++;
      }
        if(strlen($_POST['kodp'])!=6 || substr($_POST['kodp'],2,1)!="-")
      {
          $validate=false;
          $error[$ilosc]="Błędnie podany kod pocztowy ";
          $ilosc++;
      }
       }
        
        
        if($validate){
            if(isset($_POST['imie']))
            {
                $imie;
                $nazwisko;
                $miasto;
                $ulica;              
         //imie       
                $crnew=$date->prepare('SELECT id_g FROM `imie` where imiona=:im ');
                $crnew->bindValue(':im', htmlentities($_POST['imie'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                $crnew->execute();
                $ileim=$crnew->rowCount();
                    if($ileim==0)
                    {
                    $crnew1=$date->prepare('Insert into `imie` values (NULL, :im); ');
                    $crnew1->bindValue(':im', htmlentities($_POST['imie'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                    $crnew1->execute();
                    $crnew->execute();
                    $nimie=$crnew->fetch();
                    
                    } else  $nimie=$crnew->fetch();
                 $imie=$nimie['id_g'];
        //nazwisko            
                $crnewn=$date->prepare('SELECT id_n FROM `nawizska` where nazwiska=:naz ');
                $crnewn->bindValue(':naz',htmlentities($_POST['nazwisko'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                $crnewn->execute();
                $ilein=$crnewn->rowCount();
                    if($ilein==0)
                    {
                    $crnewn1=$date->prepare('Insert into `nawizska` values (NULL, :naz); ');
                    $crnewn1->bindValue(':naz', htmlentities($_POST['nazwisko'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                    $crnewn1->execute();
                    $crnewn->execute();
                    $nnaz=$crnewn->fetch();
                    
                    } else $nnaz=$crnewn->fetch();
                 $nazwisko=$nnaz['id_n'];                
                
        //miasta              
                $crnewm=$date->prepare('SELECT id_m FROM `miasta` where miasto=:mias ');
                $crnewm->bindValue(':mias', htmlentities($_POST['miasto'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                $crnewm->execute();
                $ileim=$crnewm->rowCount();
                    if($ileim==0)
                    {
                    $crnewm1=$date->prepare('Insert into `miasta` values (NULL, :mias); ');
                    $crnewm1->bindValue(':mias', htmlentities($_POST['miasto'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                    $crnewm1->execute();
                    $crnewm->execute();
                    $nmias=$crnewm->fetch();
                    
                    } else $nmias=$crnewm->fetch();
                 $miasto=$nmias['id_m'];              
                
                
        //Ulica 
                
                $crnewu=$date->prepare('SELECT id_ul FROM `ulice` where ulice=:ul ');
                $crnewu->bindValue(':ul', htmlentities($_POST['ulica'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                $crnewu->execute();
                $ileiu=$crnewu->rowCount();
                    if($ileiu==0)
                    {
                    $crnewu1=$date->prepare('Insert into `ulice` values (NULL, :uli); ');
                    $crnewu1->bindValue(':uli', htmlentities($_POST['ulica'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
                    $crnewu1->execute();
                    $crnewu->execute();
                    $nuli=$crnewu->fetch();
                    
                    } else $nuli=$crnewu->fetch();
                 $ulica=$nuli['id_ul'];                     
            
                    
            $nowyklient=$date->prepare('Insert into `klient` values (NULL,:imie, :nazwisko, :miasto,:ulica,:kod, :numer);');
            $nowyklient->bindValue(':imie', $imie,PDO::PARAM_STR);
            $nowyklient->bindValue(':nazwisko', $nazwisko,PDO::PARAM_STR);
            $nowyklient->bindValue(':miasto', $miasto,PDO::PARAM_STR);
            $nowyklient->bindValue(':ulica', $ulica,PDO::PARAM_STR);
            $nowyklient->bindValue(':kod', htmlentities($_POST['kodp'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
            $nowyklient->bindValue(':numer', htmlentities($_POST['nrd'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
            $nowyklient->execute();
            $kli=$date->prepare('select id_kl from klient where imie=:imie and nazwisko=:nazwisko and miasto=:miasto and ulica=:ulica and kod_pocztowy=:kod and numer_domu=:numer;');
            $kli->bindValue(':imie', $imie,PDO::PARAM_STR);
            $kli->bindValue(':nazwisko', $nazwisko,PDO::PARAM_STR);
            $kli->bindValue(':miasto', $miasto,PDO::PARAM_STR);
            $kli->bindValue(':ulica', $ulica,PDO::PARAM_STR);
            $kli->bindValue(':kod', htmlentities($_POST['kodp'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
            $kli->bindValue(':numer', htmlentities($_POST['nrd'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
            $kli->execute();
            $nkli=$kli->fetch();
            $klient=$nkli['id_kl'];
            
             }    }   
            if (!isset($_POST['imie'])) $klient=$_POST['ses'];
    $film=$_POST['filmy'];
    $filmy=explode(",", $film);       
  
         if(strlen($_POST['d1'])!=10 || substr($_POST['d1'],4,1)!="-" || substr($_POST['d1'],7,1)!="-" )
         {
             $validate=false;
             $error[$ilosc]="bledna data wypozyczenia";
             $ilosc++;
         }
                 if(strlen($_POST['d2'])!=10 || substr($_POST['d2'],4,1)!="-" || substr($_POST['d2'],7,1)!="-" )
         {
             $validate=false;
             $error[$ilosc]="bledna data zwrotu";
             $ilosc++;
         }
        $mozna=true;
        if($filmy[0]==null)
        { $mozna=false;
            for($i=1; $i<count($filmy); $i++)
            {
                if($filmy[$i]!=null) 
                {
                    $mozna=true;
                    break;
                }
            }
        }
        
         for($i=1; $i<count($filmy); $i++)
            {
             
                  $tak=$filmy[$i];
               
                
            }
        
      if(count($filmy)==1 && $filmy[0]=="")
      {
          $validate=false;
          $error[$ilosc]="Błędna ilość filmów!";
          $ilosc++;
      } 
        if($mozna==false)        
              {
          $validate=false;
          $error[$ilosc]="Błędna ilość filmów!";
          $ilosc++;
      }
        
        if($validate && $mozna ){
    $wypnew=$date->prepare('insert into `wypozyczenia` values(NULL,:kli,:d1,:d2,NULL);');  
    $wypnew->bindValue(':kli', $klient,PDO::PARAM_STR);
    $wypnew->bindValue(':d1', htmlentities($_POST['d1'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
    $wypnew->bindValue(':d2', htmlentities($_POST['d2'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
    $wypnew->execute();

        
    $wypnew=$date->prepare('select id from `wypozyczenia` where id_k=:kli and data_wyp=:d1 and data_zwr=:d2;');  
    $wypnew->bindValue(':kli', $klient,PDO::PARAM_STR);
    $wypnew->bindValue(':d1', htmlentities($_POST['d1'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
    $wypnew->bindValue(':d2', htmlentities($_POST['d2'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
    $wypnew->execute();
    $nwyp=$wypnew->fetch();
    $wypozyczenie=$nwyp['id'];
           
            
            
            
for($i=0; $i<count($filmy); $i++)
{ 
 
        $wstaw=$date->prepare('insert into `wyp_filmowe` values(NULL,:kl,:fil);');
        $wstaw->bindValue(':kl',htmlentities($wypozyczenie,ENT_QUOTES,"utf-8") ,PDO::PARAM_STR);
        $wstaw->bindValue(':fil', htmlentities($filmy[$i],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
        $wstaw->execute();
             
}    
    
        }
        
    }
        
$dus=$user->getLibrary(true);


if(isset($_POST['wyszuk']))
{
    
    $se='"%'.$_POST['wyszuk'].'%"';
   $movies=$date->prepare("Select wypozyczenia.id, klient.id_kl, imie.imiona, nawizska.nazwiska, miasta.miasto, ulice.ulice, wypozyczenia.data_wyp,wypozyczenia.data_zwr, wypozyczenia.data_odd from klient,ulice, nawizska, imie, wypozyczenia, miasta where klient.imie=imie.id_g and nawizska.id_N=klient.nazwisko and wypozyczenia.id_k=klient.id_kl and klient.ulica=ulice.Id_ul and klient.miasto=miasta.id_m and (imie.imiona like $se or nawizska.nazwiska like $se or wypozyczenia.data_wyp like $se )");
	$movies->execute();
	$numb=$movies->fetchAll();
	$nr=$movies->rowCount(); 
}
else {
$movies=$date->prepare('Select wypozyczenia.id, klient.id_kl, imie.imiona, nawizska.nazwiska, miasta.miasto, ulice.ulice, wypozyczenia.data_wyp,wypozyczenia.data_zwr, wypozyczenia.data_odd from klient,ulice, nawizska, imie, wypozyczenia, miasta where klient.imie=imie.id_g and nawizska.id_N=klient.nazwisko and wypozyczenia.id_k=klient.id_kl and klient.ulica=ulice.Id_ul and klient.miasto=miasta.id_m ');
	$movies->execute();
	$numb=$movies->fetchAll();
	$nr=$movies->rowCount();

}

$films=$date->prepare('Select id, tytul, plakat.url from filmy, plakat where filmy.plakat=plakat.id_p;');
$films->execute();
$fil=$films->fetchAll();
$ile=$films->rowCount();
$fi=[];
$fi2=[];
$fi3=[];

for($i=0; $i<$ile; $i++)
{   $fi[$i]=$fil[$i]['tytul'];

    $fi2[$i]=$fil[$i]['id'];

    $fi3[$i]=$fil[$i]['url'];
}
?>
<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/main.css">
        	<link rel="stylesheet" href="css/second.css">
	<link rel="stylesheet" href="css/wypozyczenia.css">
	<link rel="shortcut icon" href="grafiki/dvd.jpg">
	<script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.easing.1.3.js"></script>

    <script>
       var movies=<?php echo json_encode($fi) ?>;
       var mid=<?php echo json_encode($fi2) ?>;
       var plakaty=<?php echo json_encode($fi3) ?>;
       var imiona=<?php echo json_encode($dus['imie']) ?>;
       var nazwiska=<?php echo json_encode($dus['nazwisko']) ?>;
       var ulice=<?php echo json_encode($dus['ulica']) ?>;
       var miasta=<?php echo json_encode($dus['miasto']) ?>;
       var idk=<?php echo json_encode($dus['id']) ?>;
    </script>

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
                <div id="wysection"><input type="submit" value="Dodaj" id="new" onclick="newyp();"/>
                    <form action="wyplist.php" method="POST"><input id="searchwyp" name="wyszuk" typ="text" placeholder="wyszukiwanie"/><input type="submit" id="szukaj"></form>
			
				<?php	

				for($i=0; $i<$nr; $i++)
				{
				$r1=$numb[$i]['miasto'];
				$r2=$numb[$i]['imiona'];
				$r3=$numb[$i]['nazwiska'];	
				$w[0]=$numb[$i]['data_wyp'];	
				$w[1]=$numb[$i]['data_zwr'];	
				$w[2]=$numb[$i]['data_odd'];
                $id=$numb[$i]['id'];
				
echo<<<EN
					<div class="wypo">
					<div class="kl">
							<p class="titw">Dane klienta </p>
							<p class="wyhej">Imie: $r2<br/>
										Nazwisko: $r3<br/>
										Miasto:$r1
										
							</p>
						</div>							
						<div class="lis">
						<div class="hhh">
						<p class="jej">Data wypożyczenia<br/>$w[0]
						
						</p>
						<p class="jej">Termin zwrotu<br/>$w[1]</p>
						<p class="jej">Oddano<br/>$w[2]</p>
						<button id="zwr" onclick="zwrot('$id');">zwrot</button>
                        </div>
						<div class="wypmovies">					
EN;
			$wypli=$date->prepare('select plakat.url, filmy.kara, filmy.cena from `filmy`, `plakat`,`wyp_filmowe`,`wypozyczenia` where filmy.plakat=plakat.id_p and wyp_filmowe.id_filmu=filmy.id and wyp_filmowe.id_wypo=wypozyczenia.id and wypozyczenia.id=:re ;');
			$wypli->bindValue(':re', $numb[$i]['id'],PDO::PARAM_STR);
			$wypli->execute();
			$lel=$wypli->fetchAll();
			$lnr=$wypli->rowCount();
				$cen=0;
				for($j=0; $j<$lnr; $j++)
				{
					$ig=$lel[$j]['url'];
					$cen+=$lel[$j]['cena'];
echo<<<RE
					<img class="teje" src="plakaty/$ig"/>
RE;
}							
echo "cena: $cen zł" ;
						echo'</div>';
						echo'</div>';

echo'</div>';
			}
					?>

				</div>
		</div>
	</main>
        	<script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript" src="js/wyp.js"></script>
        	
	</body>
</html>