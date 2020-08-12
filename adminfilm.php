<?php
require_once 'classes.php';
$user= new User($date);
if(!isset($_SESSION['nick']) && $user->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$_SESSION['tryb'])){
    header('location:index.php');
    exit();
}
$mov=new Movie($date);
$rezy=new Director($date);
$dic=new Dictionary($date);
$mar=new Ocena($date);
if(isset($_GET['mode']))
    $mod=$_GET['mode'];
else $mod='create';
    if(isset($_POST['wyszuf'])){
	   $mov->wyszukiwanie( $_POST['wyszukajpo'],$_POST['wyszuf']);
    }
	$numb=$mov->getLibrary();

    $rezyser=$rezy->getLibrary();

    $gatunek=$dic->getLibrary('gatunek');

	$numb=$mov->getLibrary();
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
                   ?> </div>  </div>  <form method="post" action="adminfilm.php">
               <div id="strza"> <select id="poczym" name="wyszukajpo" onclick="switchArrow()" >
                    <option value="tytul">Tytul</option>
                    <option value="rezyser">Rezyser</option>
                    <option value="rok">Rok produkcji</option>
                    <option value="nosnik">nosnik</option>
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
                    <table id="anotherone">
                        <tr>
                            <td class="idkerp">plakat</td><td class="idker">Tytul</td><td class="idker">rezyser</td><td class="idker">Rok produkcji</td><td class="idker">Gatunek</td><td class="idker">Opis</td><td class="idker">Cena</td><td class="idker">kara</td><td class="idker">tapeta</td><td class="idker">options</td>
                        </tr>

                        <?php
                        
                            foreach($numb as $value){
                            $id=$value['id']; $pla=$value['url']; $tytul=$value['tytul']; $rezyser=$value['imiona']." ".$value['nazwiska']; $rok=$value['rok_produkcji'];$gatunek=$value['gatunek'];$wall=$value['wu']; $opis=$value['opis'];$kara=$value['kara'];$cena=$value['cena'];
                            echo "<tr>"; 
                            echo"<td class='idkerp'><img class='adminimg' src='plakaty/$pla'></td><td class='idker'>$tytul</td><td class='idker'>$rezyser</td><td class='idker'>$rok</td><td class='idker'>$gatunek</td><td class='idkero'>$opis</td><td class='idker'>$cena zł</td><td class='idker'>$kara zł</td><td class='idker'><img class='adminwall' src='tapety/$wall'></td>";
                            echo"<td class='options'>";
                                echo"<a class='aadmin' href='filmadminoptions.php?id=$id&mode=edit'>edytuj</a>";
                            echo"</td>";    
                                echo"</tr>";
                        
                            }
                        
                        
                        
                        ?>
                                                <tr>
                            <td colspan='11' class="trrrr"> <a class='aadmin' href='filmadminoptions.php?mode=create'>dodaj</a> </td>
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