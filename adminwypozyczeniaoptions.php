<?php
require_once 'classes.php';
$user= new User($date);
if(isset($_SESSION['tryb']))
    $tryb=$_SESSION['tryb'];
else $tryb=0;
if(!isset($_SESSION['nick']) || $user->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$tryb)!=true || !isset($_GET['mode'])  ){
    header('location:index.php');
    exit();
}

if(isset($_GET['mode']))
    $mod=$_GET['mode'];
else $mod='create';
$kli=new Klient($date);
$wypo=new Wypozyczenie($date);
$movie=new Movie($date);
    $numb4=$movie->getLibrary($date);
if($mod=='edit'){
    if( !isset($_GET['id']) ){
        header('location:index.php');
        exit();
    }
    $wypo->setSingle($_GET['id']);    
    $numb2=$wypo->getLibrary();
    $numb3=$wypo->getMovies($numb2['Id']);
    $wypo->clearSingle();
    if (isset($_POST['klient'])){
        $moviesUp=explode(',',$_POST['movies']);
        $wypo->updateWypozyczenie($_GET['id'],$_POST['klient'],$_POST['data_wyp'],$_POST['termin_zwr'],$_POST['data_odd'],$_POST['status'],$moviesUp );
    }
}
if($mod=='create')
    if (isset($_POST['klient'])){
        $moviesUp=explode(',',$_POST['movies']);
        $wypo->wypozyczenie(true,$_POST['klient'],$_POST['data_wyp'],$_POST['termin_zwr'],$_POST['data_odd'],$_POST['status'],$moviesUp );
    }

$numb=$kli->getLibrary();



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
                
                
                    <form action="adminwypozyczeniaoptions.php?id=<?php echo $_GET['id']?>&mode=<?php echo "$mod" ?>"  enctype="multipart/form-data" method="POST">
                        <select name="klient" class='inps'>
                            <?php
                                foreach($numb as $value){
                                    $t='';
                                    $id=$value['id_kl']; $i=$value['imiona'];$n=$value['nazwiska'];
                                    if($id==$numb2['id_kl']) $t='selected="selected"';
                                    echo "<option value='$id' $t>$i  $n</option>";
                                }
                            ?>
                        </select>
                        <input type="date" class="inp" name='data_wyp' title="data wypożyczenia"  placeholder='data wyporzyczenia' value="<?php  if($mod=='edit')echo $numb2['data_wyp'] ?>">
                        <input type="date" class="inp" name='termin_zwr' title="termin zwrotu" placeholder='termin zwrotu' value="<?php  if($mod=='edit')echo $numb2['data_zwr'] ?>">
                        <input type="date" class="inp" name='data_odd' title="data zwrotu" placeholder='data oddania' value="<?php  if($mod=='edit')echo $numb2['data_odd'] ?>">
                        
                        <select class='inps' name='status' title="status">
                            <option value="0"<?php if($mod=='edit')if($numb2['status']=='oczekujace') echo'selected="Selected"'; ?> >Oczekujące</option>
                            <option value="1"<?php if($mod=='edit')if($numb2['status']=='Wysłane') echo'selected="Selected"'; ?> >Wysłane</option>
                            <option value="2"<?php if($mod=='edit')if($numb2['status']=='Zwrócone') echo'selected="Selected"'; ?>>Zwrócone</option>
                            <option value="3"<?php if($mod=='edit')if($numb2['status']=='Anulowane') echo'selected="Selected"'; ?>>Anulowane</option>
                        </select>
                        <select class='inps' id="addMovie" readonly>
                            <?php
                                foreach($numb4 as $value){
                                    
                                    $id=$value['id']; $post=$value["url"]; $i=$value['tytul'];$n="(".$value['rok_produkcji'].")";
                                    
                                    echo "<option value='$id,$post'>$i  $n</option>";
                                }
                            ?>
                        </select>
                        <div class="inpb1" onclick="addMovie()">Dodaj film</div>
                       <div id="listafilmow">
                           <?php
                            if($mod=='edit') foreach($numb3 as $value){
                                $pla=$value['url'];
                                $id=$value['id_filmu'];
                                echo"<div class='par' id='d$id'><img class='minpla' src='plakaty/$pla' id='$id'><img class='closeicon' id='x$id' src='grafiki/icon.png' onclick='deleteFromList($id,d$id)'></div>";
                            }
                           ?>
                        </div>
                        <input type="hidden" name="movies" id="moviesList">
                        <input type="submit" value="zapisz zmiany"  class="inpb1">

                        




                </form>
                </div>
                
              
            </div>
            <script type="text/javascript">
                tru=true;
                var tablica=new Array();
                var nod=document.getElementsByClassName('minpla');
                for(var i=0; i<nod.length; i++){
                    tablica[i]=nod[i].id;
                } 
                document.getElementById('moviesList').value=tablica;
    
                function deleteFromList(id,overdiv){
                    tablica.splice(tablica.findIndex(function(x){return x==id}),1);
                    $(overdiv).remove();
                    document.getElementById('moviesList').value=tablica;
                }
                function addMovie(){
                    let one=document.getElementById('addMovie').value[0];
                    let poster=document.getElementById('addMovie').value;
                    poster=poster.substring(2,poster.length);
                    tablica.push(one);
                    let g="<div class='par' id='d"+one+"'><img class='minpla' src='plakaty/"+poster+"' id='"+one+"'><img class='closeicon' id='x"+one+"' src='grafiki/icon.png' onclick='deleteFromList("+one+",d"+one+")'></div>";
                    document.getElementById('listafilmow').innerHTML+=g;
                    document.getElementById('moviesList').value=tablica;
                }
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