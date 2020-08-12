<?php
require_once 'classes.php';
$user= new User($date);
if(!isset($_SESSION['nick']) || $user->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$_SESSION['tryb'])!=true ){
    header('location:index.php');
    exit();
}
$kli=new Wypozyczenie($date);
$dic=new Dictionary($date);
if(isset($_GET['mode']))
    $mod=$_GET['mode'];
else $mod='create';
    if(isset($_POST['wyszuf'])){
	   $kli->wyszukiwanie( $_POST['wyszukajpo'],$_POST['wyszuf']);
    }
$numb=$kli->getLibrary();

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
                   ?> </div> </div>   <form method="post" action="adminwypozyczenia.php">
               <div id="strza"> <select id="poczym" name="wyszukajpo" onclick="switchArrow()" >
                    <option value="imie">imie</option>
                    <option value="nazwisko">nazwisko</option>
                    <option value="status">status</option>
                    <option value="data">data</option>
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
                            <td class="idkerp">imie kliena</td><td class="idker">nazwisko klienta</td><td class="idker">status</td><td class="idker">data wypożyczenia</td><td class="idker">termin zwrotu</td><td class="idker">data zwrócenia</td><td class="idker">Opcje</td>
                        </tr>

                        <?php
                        
                            foreach($numb as $value){
                                $id=$value['Id'];$i=$value['imiona'];$n=$value['nazwiska'];$d1=$value['data_wyp'];$d2=$value['data_zwr'];$d3=$value['data_odd'];$s=$value['status'];
                                echo"<tr>"; if(empty($d3)) $d3='--';
                                echo"<td class='idkerp'>$i</td><td class='idkerp'>$n</td><td class='idkerp'>$s</td><td class='idkerp'>$d1</td><td class='idkerp'>$d2</td><td class='idkerp'>$d3</td>";
                                                             echo"<td class='options'>";

                                  echo"<a class='aadmin' href='#' onclick='see($id,1)' >zatwierdzi</a><a href='#' class='aadmin' onclick='see($id,2)' >anuluj</a><a class='aadmin' href='#' onclick='see($id,3)'>zwrot</a><a href='adminwypozyczeniaoptions.php?mode=edit&id=$id' class='aadmin' >edytuj</a>";
                            echo"</td>"; 
       
                                echo"</tr>";
                                echo"<tr><td colspan='7' >";
                                echo"<ul class='lisfilms'>";
                                $numb1=$kli->getMovies($id);
                                $cena=0;
                                foreach($numb1 as $value1){
                                    $t=$value1['tytul'];
                                    echo"<li>$t</li>";
                                    $cena+=$value1['cena'];
                                }
                                echo '</ul>';
                                echo "<div>koszt: $cena zł</div>";
                                echo"</td>";
                                echo"</tr>";
                                
                            }
                        
                        
                        
                        ?>
                        <tr>
                            <td colspan="7"><a class='aadmin' href='adminwypozyczeniaoptions.php?mode=create'>dodaj</a></td>
                        <tr>
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
                    
                function see(id,mod){
                                       $.ajax({
            type:"POST", 
            url:"woa.php",
            data: {mode:mod,id:id},
            success: function(tex) {
             console.log(tex);
        },
       
        });
                    
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