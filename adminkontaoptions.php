<?php
require_once 'classes.php';
$kli= new User($date);
if(isset($_SESSION['tryb']))
    $tryb=$_SESSION['tryb'];
else $tryb=0;
if(!isset($_SESSION['nick']) || $kli->checkPrivileges($_SESSION['user'],$_SESSION['nick'],$tryb)!=true || !isset($_GET['mode']) ){
    header('location:index.php');
    exit();
}


$kli2=new Klient($date);
$dic=new Dictionary($date);
if($_GET['mode']=='edit'){
    if( !isset($_GET['id']) ){
        header('location:index.php');
        exit();
    }
        
    $numb2=$kli->getUserbyId($_GET['id']);
}
if(isset($_GET['mode']))
    $mod=$_GET['mode'];
else $mod='create';
$numb=$kli2->getLibrary();

if(isset($_POST['login'])){
    if($_GET['mode']=='edit'){
    $kli->updateUser($_POST['login'],$_POST['email'],$_POST['haslo'],$_POST['haslo'],$_GET['id']);
         $kli->updateStat($_POST['typ'],$_GET['id']);  
         $kli->upk($_POST['klient'],$_GET['id']);  
    }else if($_GET['mode']=='create'){
           $kli->createUser($_POST['login'],$_POST['haslo'],$_POST['email'],$_POST['klient'],$_POST['typ']); 
    }
}
$mod=$_GET['mode'];

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
                   ?> </div>  </div>  <form method="post" action="library.php">
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
                
                
                <form action="adminkontaoptions.php?id=<?php  if(isset($_GET['id']))echo$_GET['id']?>&mode=<?php echo "$mod" ?>"  enctype="multipart/form-data" method="POST">
                    

                    <input type="text" class="inp" name='login' title="login" placeholder='login' value="<?php if($_GET['mode']=='edit')echo $numb2['login'] ?>">
                    <input type="text" class="inp" name='email' title="email" placeholder='email' value="<?php if($_GET['mode']=='edit')echo $numb2['email']?>" >
                    <input type="text" class="inp" name='haslo' title="kasło"  placeholder='hasło' >
                    <select name='klient'  class='inps'>
                    <?php
                        foreach($numb as $value){
                            $t='';
                            $id=$value['id_kl']; $i=$value['imiona'];$n=$value['nazwiska'];
                            if($id==$numb2['klient']) $t='selected="selected"';
                            echo "<option value='$id' $t>$i  $n</option>";
                        }
                      ?>
                    </select>
                    <select class='inps' name='typ' title="typ konta">
                        <option value="1"<?php if($_GET['mode']=='edit')if($numb2['Typkonta']==1) echo'selected="Selected"'; ?> >User</option>
                        <option value="2"<?php if($_GET['mode']=='edit')if($numb2['Typkonta']==2) echo'selected="Selected"'; ?>>Moderator</option>
                        <option value="3"<?php if($_GET['mode']=='edit')if($numb2['Typkonta']==3) echo'selected="Selected"'; ?>>Admin</option>
                    </select>
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