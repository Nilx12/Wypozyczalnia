<?php
require_once 'conn.php';
session_start();
if(isset( $_SESSION['log']))
{
    header("location:index.php");
    exit();
}
    if(isset($_POST['login']))
    {
        
        
        
        $validate=true;
        $skey="6LcP5FEUAAAAAOYY4fwiAQQ3q1NM0SfEDVFISUdg";
        $spr=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$skey.'&response='.$_POST['g-recaptcha-response']);
        $odp=json_decode($spr);  
            if(strlen($_POST['login'])<3)
            {
                $error_login="za krótki nick";
                $validate=false;
            } else if(strlen($_POST['login'])>25)
            {
                $error_login="za długi nick!";
                $validate=false;
            } 
         else {
            $czyjest=$date->prepare('select * from konta where login=:log;');
            $czyjest->bindValue(':log', htmlentities($_POST['login'],ENT_QUOTES,"utf-8"),PDO::PARAM_STR);
            $czyjest->execute();
            $ile=$czyjest->rowCount();
             if($ile>0)
             {
                $validate-false;
                $error_login="Ta nazwa użytkownika jest zajęta";
             }
         }
        	$passhash=password_hash($_POST['haslo'], PASSWORD_DEFAULT);
   
            
            if($_POST['haslo']!=$_POST['repeat'])
               {
                   $error_rep="Hasła nie są jendakowe!";
                   $validate=false;
               }
        
            if(strlen($_POST['haslo'])<8)
            {
                    $error_haslo="Za proste hasło!";
                   $validate=false;
            }
        
            $safemail=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if(!filter_var($safemail, FILTER_VALIDATE_EMAIL))
            {
                $validate=false;
                $error_email="Błędny email";
            }
            if(!isset($_POST['ac']))
            {
                $validate=false;
                $error_ac="Zaakceptuj regulamin!";
            }
            if($odp->success==false)
	       {
		      $validate=false;
                $error_captcha="Potwierdź ze jesteś człowiekiem!";
            }
        
                    
                    
                        if($validate)
                        {
                            
                            $code="khcgfwgyvhd";
                       
                            $newuser=$date->prepare('insert into konta values(NULL,:log, :pas, :em,1,:cod);');
                            $newuser->bindValue(':log', $_POST['login'], PDO::PARAM_STR);
                            $newuser->bindValue(':pas', $passhash, PDO::PARAM_STR);
                            $newuser->bindValue(':em', $_POST['email'], PDO::PARAM_STR);
                            $newuser->bindValue(':cod', $code, PDO::PARAM_STR);
                            $newuser->execute();
                            require 'mailer/PHPMailerAutoload.php';

                                $login=$_POST['login'];
                                $link="http://localhost/wypo/acept.php?login=$login&code=$code";
                                require_once('mailer/class.phpmailer.php');   
                                require_once('mailer/class.smtp.php');   
                                $mail = new PHPMailer(); 
                                $mail->From = "karol129912@wp.pl";   
                                $mail->FromName = "Wypożyczalnai filmowa w �?odzi";   
                                $mail->Host = "smtp.wp.pl";  
                                $mail->Mailer = "smtp";    
                                $mail->SMTPAuth = true;    
                                $mail->Username = "karol129912@wp.pl";    
                                $mail->Password = "karol12";    
                                $mail->Port = 587; 
                                $mail->Subject = "temat";    
                                $mail->Body = "Potiwerdź swój email wchodząc w ten link $link";   
                                $mail->SMTPAutoTLS = false;   
                                $mail->SMTPSecure = '';   
                                $mail->AddAddress ($safemail,"nowy użytkownik");   
                                                                                   
                                $mail->Send();

                            $_SESSION['newuse']=true;
                            header('location:index.php');
                        }
    }
?>
<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/second.css">
	<link rel="shortcut icon" href="grafiki/dvd.jpg">
<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<main>

            <div id="reje">
                <form action="rejeform.php" method="POST">
                    <div id="rejestracja">
                        <div id="both">
                        <div id="forms">
                            <input type="text" class="oneofrej" name="login"><br>
                            <?php   
                                if(isset($error_login))
                                    echo"<span class='error'>$error_login</span>";
                                else echo"<br>";
                            ?>
                            <input type="password" class="oneofrej" name="haslo"><br>
                            <?php   
                                if(isset($error_haslo))
                                    echo"<span class='error'>$error_haslo</span>";
                                else echo"<br>";
                            ?>
                            <input type="password" class="oneofrej" name="repeat"><br>
                            <?php   
                                if(isset($error_rep))
                                    echo"<span class='error'>$error_rep</span>";
                                else echo"<br>";
                            ?>
                            <input type="text" class="oneofrej" name="email"><br>
                            <?php   
                                if(isset($error_email))
                                    echo"<span class='error'>$error_email</span>";
                                else echo"<br>";
                            ?>
                  
                        </div>
                        <div id="texts">
                            <p class="lrej1">Login</p>
                            <p class="lrej">Hasło</p>
                            <p class="lrej">Powtórz hasło</p>
                            <p class="lrej">Adres email</p>
                            <label><input id="acce" name="ac" type="checkbox">Akceptuje regulamin</label> 
                               <?php   
                                if(isset($error_ac))
                                    echo"<br><span class='error'>$error_ac</span>";
                                
                            ?>
                      
                        </div>
                        
                        </div><div id="capth"><div class="g-recaptcha" data-sitekey="6LcP5FEUAAAAAPtXmjyxXu6h3VqYd-7ZxC7gjzZc"></div></div>
                                <?php   
                                if(isset($error_captcha))
                                    echo"<br><span class='error'>$error_captcha</span>";
                                
                            ?>
                           
                       <input type="submit" value="utwórz konto">
                    </div>    
                    
                </form>
            </div>

		</main>
	</body>
</html>