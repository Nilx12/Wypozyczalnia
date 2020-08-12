<?php
require_once 'classes.php';
$user= new User($date);
if(!isset($_SESSION['nick']) || $user->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$_SESSION['tryb'])!=true  || !isset($_GET['mode'])){
    header('location:index.php');
    exit();
}



if(!isset($_GET['id']) && $_GET['mode']=='edit') header('location:adminklient.php');
$kli=new Klient($date);
$dic=new Dictionary($date);


if($_GET['mode']=='edit'){
    if( !isset($_GET['id']) ){
        header('location:index.php');
        exit();
    }
    $numb=$kli->getClientById($_GET['id']);  
}
    if(isset($_GET['mode']))
    $mod=$_GET['mode'];
else $mod='create';

if(isset($_POST['imie'])){
    $im=$dic->setValue($_POST['imie'],'imie');
    $naz=$dic->setValue($_POST['nazwisko'],'nazwisko');
    $mi=$dic->setValue($_POST['miasto'],'miasto');
    $ul=$dic->setValue($_POST['ulica'],'ulica');
    if($mod=='create')
        $kli->createClient($im,$naz,$mi,$ul,$_POST['kod'],$_POST['nrdom']);
    else if($mod=='edit')
        $kli->updateKlient($im,$naz,$mi,$ul,$_POST['kod'],$_POST['nrdom'],$_GET['id']);   
    
}
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
                
                
                <form action="adminklientoptions.php?id=<?php echo $_GET['id']?>&mod=<?php echo "&mode=$mod" ?>"  enctype="multipart/form-data" method="POST">
                    

                    <input type="text" class="inp" name='imie' title="imie" placeholder='imie' value="<?php if($_GET['mode']=='edit')echo $numb['imiona']?>">
                    <input type="text" class="inp" name='nazwisko' title="nazwisko" placeholder='nazwisko' value="<?php if($_GET['mode']=='edit')echo $numb['nazwiska']?>">
                    <input type="text" class="inp" name='miasto' title="miasto" placeholder='miasto' value="<?php if($_GET['mode']=='edit')echo $numb['miasto']?>">
                    <input type="text" class="inp" name='ulica' title="ulica" placeholder='ulica' value="<?php if($_GET['mode']=='edit')echo $numb['ulice']?>">
                    <input type="text" class="inp" name='kod' title="kod pocztowy" placeholder='kod pocztowy' value="<?php if($_GET['mode']=='edit') echo $numb['kod_pocztowy']?>">
                    <input type="text" class="inp" name='nrdom' title="numer domu" placeholder='numer domu' value="<?php if($_GET['mode']=='edit')echo $numb['numer_domu']?>">
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