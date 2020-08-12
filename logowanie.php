<?php
require_once 'conn.php';
session_start();
if(isset( $_SESSION['log']))
{
    header("location:index.php");
    exit();
}

?>

<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wypożyczalia filmowa</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/second.css">
	<link rel="shortcut icon" href="grafiki/dvd.jpg">

	</head>
	<body>
		<main>

            <div id="logform"><div class="cont"><p class="logtitle">Wypożyczalnia filmowa</p> <img class="mark" src="grafiki/dvd.jpg"></div>
                <form action="log.php" method="POST">
                    <input type="text" class="wpro" placeholder="Nazwa użytkownika" name="login"/><br>
                    <input type="password" class="wpro" placeholder="Hasło" name="password"/><br>
                    <a class="dokladnie" href="przyp.php">Zapomniałeś hasła?</a><a class="dokladnie" href="rejeform.php">Nie masz jeszcze konta?</a><br>
                    <input type="submit" class="logbutton" value="zaloguj"/>
                
                </form>
            </div>

		</main>
	</body>
</html>