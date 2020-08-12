<?php
require_once 'classes.php';
$user= new User($date);
if(!isset($_SESSION['nick']) && $user->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$_SESSION['tryb'])){
    header('location:index.php');
    exit();
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
                   ?> </div></div>    <form method="post" action="library.php">
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
            
			
				<div id="menuadmin">
                    <table id="admintable">
                        <tr>
                            <td class="tdi"><a href='adminklient.php' class='er'><div class='trr'>Klienci</div></a></td>
                        </tr>
                        <tr>
                            <td class="tdi"><a href='adminwypozyczenia.php' class='er'><div class='trr'>Wypozyczenia</div></a></td>
                        </tr>
                        <tr>
                            <td class="tdi"><a href='adminfilm.php' class='er'><div class='trr'>Filmy</div></a></td>
                        </tr>
                        <tr>
                            <td class="tdi"><a href='adminkonta.php' class='er'><div class='trr'>Konta</div></a></td>
                        </tr>                 
                    </table>  
	
					
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

