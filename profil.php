<?php
require_once 'classes.php';
if(!isset($_SESSION['nick']))
{  header('location:index.php');
exit();
}
$konto=new User($date);
$klient=new Klient($date);
$dic=new Dictionary($date);
$numb1=$klient->getClientById($_SESSION['klient']);


if(isset($_POST['imie']))
{
    $m=$dic->setValue($_POST['miasto'],'miasto');
    $u=$dic->setValue($_POST['ulica'],'ulica');
    $i=$dic->setValue($_POST['imie'],'imie');
    $n=$dic->setValue($_POST['nazwisko'],'nazwisko');

    $konto->updateUser($_POST['login'],$_POST['email'],$_POST['has1'],$_POST['hasp'],$_SESSION['user']);
    if($numb1['id_kl']!=0)
    $klient->updateKlient($i,$n,$m,$u,$_POST['kod'],$_POST['numer'],$numb1['id_kl']);
    else{
         $new=$klient->createClient($i,$n,$m,$u,$_POST['kod'],$_POST['numer']);
        $konto->upk($numb1['id'],$new);
    }
}
$numb=$konto->getUserData($_SESSION['nick']);
$numb1=$klient->getClientById($_SESSION['klient']);
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
                    
                    <p class='titt'>Dane użytkownika</p>
                    <form action="profil.php" method='post'>
                    <input class="inp" type="text" name="login" placeholder="login" value=<?php echo $numb['login']; ?>>
                    <input class="inp" type="text" name="email" placeholder="email" value=<?php echo $numb['email']; ?>>
                    <input class="inp" type="text" name="imie" placeholder="imie" value=<?php echo $numb1['imiona']; ?>>
                    <input class="inp" type="text" name="nazwisko" placeholder="nazwisko" value=<?php echo $numb1['nazwiska']; ?>>
                    <input class="inp" type="text" name="miasto" placeholder="miasto" value="<?php echo $numb1['miasto']; ?>">
                    <input class="inp" type="text" name="ulica" placeholder="ulica" value="<?php print( $numb1['ulice']); ?>">
                    <input class="inp" type="text" name="kod" placeholder="kod pocztowy" value=<?php echo $numb1['kod_pocztowy']; ?>>
                    <input class="inp" type="text" name="numer" placeholder="numer domu" value=<?php echo $numb1['numer_domu']; ?>>
                    
                        
                        
                      <input class="inph" type="password" name="has1" placeholder="Nowe hasło">
                    <input class="inph" type="password" name="hasp" placeholder="Powtórz hasło">
                    <div class="inpb" onclick="trr()">Zmien hasło</div>
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