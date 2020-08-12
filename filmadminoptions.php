<?php
require_once 'classes.php';
$user= new User($date);
if(isset($_SESSION['tryb']))
    $tryb=$_SESSION['tryb'];
else $tryb=0;
if(!isset($_SESSION['nick']) || $user->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$tryb)!=true || !isset($_GET['mode']) ){
    header('location:index.php');
    exit();
}
$film=new Movie($date);
$rez=new Director($date);
$dic=new Dictionary($date);



if($_GET['mode']=='edit'){
    if( !isset($_GET['id']) ){
        header('location:index.php');
        exit();
    }
    $film->wyszukiwanie('id',$_GET['id']);
    $numb=$film->getLibrary($_GET['id']);
}
if(isset($_POST['tytul']))
{
    
    $im=$dic->setValue($_POST['rezyser_i'],'imie');
    $naz=$dic->setValue($_POST['rezyser_n'],'nazwisko');
    $rezyser=$rez->createDirector($im,$naz);
    $gatunek=1;
    $plakat=$film->setPoster();
    $tap=$film->setwallp();
    $nosnik=$dic->setValue($_POST['nosnik'],'nosnik');
    if($_GET['mode']=='edit')
    $film->updateMovie($_POST['tytul'],$rezyser,$_POST['rok'],$gatunek,$_POST['opis'],$_POST['cena'],$_POST['kara'],$nosnik,$plakat,$_GET['id']);
    else if($_GET['mode']=='create')
    $film->createMovie($_POST['tytul'],$rezyser,$_POST['rok'],$gatunek,$_POST['opis'],$_POST['cena'],$_POST['kara'],$nosnik,$plakat,$tap);
        
}

if(isset($_GET['mode']))
    $mod=$_GET['mode'];
else $mod='create';

if(isset($_SESSION['tryb']))
$tryb=$_SESSION['tryb'];
else $tryb=0;
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
 <div id="about"><div id="d"><div id="salok"> 
                   
                   <?php
                   
                    
               
                    if(isset($_SESSION['nick'])){ echo $_SESSION['nick'];
                    echo"<br/><a class='profoption' href='profil.php'>Profil</a>";
                   if($tryb==3) echo"<a class='profoption' href='admin.php'>Admin</a>";
                    echo"<a class='profoption' href='logout.php'>Wyloguj</a>";
                                                }
                    else echo"<a href='logowanie.php'>Zalaguj</a>";
                   ?> </div> </div>   <form method="post" action="library.php">
               <div id="strza"> <select id="poczym" name="wyszukajpo" onclick="switchArrow()" >
                    <option value="tytul">Tytul</option>
                    <option value="rezyser">Rezyser</option>
                    <option value="rok">Rok produkcji</option>
                </select>  <img class="str" src="grafiki/ad.png" >   </div>
                        <div id="inputsearch">  <input type="text" placeholder="Wyszukaj" name="wyszuf" id="wyszuf"> <input type='image' class="sicon"src="grafiki/icons.png" ></div></form>
                      
        </div>
            <div id="menu">
                <nav>
                    <ul id="menlist">
                        <li><a href="index.php" class="ma">Glowna</a></li>
                        <li><a href="library.php" class="ma">Biblioteka</a></li>
                        <li><a href="ranking.php" class="ma">Ranking</a></li>
                        <li><a href="koszyk.php" class="ma"><img class='kosyzkobraz' src='grafiki/woz.png'></a></li>
                        
                        
                        
                    </ul>
                </nav>
            </div>
            <div id="container">    
            
            
       <div id="profilstats">
                
                
                <form action="filmadminoptions.php?id=<?php echo $_GET['id']?>&mod=<?php echo "&mode=$mod" ?>"  enctype="multipart/form-data" method="POST">
                    
                    <input type="text" class="inp" name='tytul' title="tytuł" placeholder='tytuł' value="<?php if($_GET['mode']=='edit')echo $numb[0]["tytul"]?>">
                    <input type="text" class="inp" name='rezyser_i' title="Imie reżysera" placeholder='imie rezysera' value="<?php if($_GET['mode']=='edit')echo $numb[0]["imiona"]?>">
                    <input type="text" class="inp" name='rezyser_n' title="nazwisko reżysera" placeholder='nazwisko rezysera' value="<?php if($_GET['mode']=='edit')echo $numb[0]["nazwiska"]?>">
                    <input type="text" class="inp" name='rok' title="rok produkcji" placeholder='rok produkcji' value="<?php if($_GET['mode']=='edit')echo $numb[0]["rok_produkcji"]?>">
                    <input type="text" class="inp" name='gatunek' title="gatunek" placeholder='gatunek' value="<?php if($_GET['mode']=='edit')echo $numb[0]["gatunek"]?>">
                    <input type="text" class="inp" name='cena' title="cena" placeholder='cena' value="<?php if($_GET['mode']=='edit')echo $numb[0]["cena"]?>">
                    <input type="text" class="inp" name='kara' title="kara" placeholder='kara' value="<?php if($_GET['mode']=='edit')echo $numb[0]["kara"]?>">
                    <input type="text" class="inp" name='nosnik' title="nośnik" placeholder='Nosnik' value="<?php if($_GET['mode']=='edit')echo $numb[0]["nosnik"]?>">
                    <textarea class="inp" name='opis' title="opis" ><?php if($_GET['mode']=='edit')echo $numb[0]["opis"]?></textarea>
                    <input type="file" class="inp" title="plakat" name="plakat">
                    <input type="file" class="inp" title="tapeta" name="tapeta">
                    <input type="submit" value="zapisz zmiany"  class="inpb1">

                
                </form>
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
                     
                function trr(){
                    $('.inph').css('display','block');
                    $('.inpb').css('display','none');
                    
                }
                
                         $(document).ready(function(){
                        trele=true;
                    $('#salok').click(function(){
                        if(trele){
                         $('#salok').css('height','auto');
                         $('.profoption').css('display','block');
                        trele=false;
                        }else{
                            $('#salok').css('height','28px');
                         $('.profoption').css('display','none');
                        trele=true;
                        }
                       
                    })
                    
                    
                });       
             </script>   
	</body>
</html>