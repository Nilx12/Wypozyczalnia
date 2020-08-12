<?php
require_once 'conn.php';
	if(isset($_POST['val']))
	{
		$se=$_POST['se'];
        $se=htmlentities($se,ENT_QUOTES,"utf-8");
		switch($se)
		{
			case "imie": $se2="imiona";
			break;
			case "nawizska": $se2="nazwiska";
			break;
			case "ulice": $se2=$se;
			break;
			case "miasto": $se2="miasta";
			
			
		}
        
        
		$e=$date->prepare("SELECT * from $se where $se2=:val;");
		$e->bindValue(':val', htmlentities($_POST['val'],ENT_QUOTES,"utf-8"), PDO::PARAM_STR);
		$e->execute();
		$ar=$e->rowCount();
		
		
		if ($ar==0){
		$que=$date->prepare("INSERT INTO $se VALUES(NULL, :val)");
		$que->bindValue(':val', htmlentities($_POST['val'],ENT_QUOTES,"utf-8"), PDO::PARAM_STR);
		$que->execute();
		}
	}

	$imie=$date->prepare('SELECT imiona from imie;');
	$imie->execute();
	$imnum=$imie->fetchAll();
	$nri=$imie->rowCount();
	
		$imie=$date->prepare('SELECT nazwiska from nawizska;');
	$imie->execute();
	$imnum1=$imie->fetchAll();
	$nri1=$imie->rowCount();

			$imie=$date->prepare('SELECT miasto from miasta;');
	$imie->execute();
	$imnum2=$imie->fetchAll();
	$nri2=$imie->rowCount();
	
	$imie=$date->prepare('SELECT ulice from ulice;');
	$imie->execute();
	$imnum3=$imie->fetchAll();
	$nri3=$imie->rowCount();
	
	

	
?>

<!doctype HTML>
<html lang="pl">

	<head> <meta charset="UTF-8"/><title>Wyporzyczalia filmowa</title>

	<link rel="shortcut icon" href="grafiki/dvd.jpg">
	
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.0.custom.min.js"></script>
	<script type="text/javascript" src="js/sl.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
		<link rel="stylesheet" href="css/main.css">
		</head>
	<body>
		<main>
		<div id="menu"><nav>
				
		</nav></div>
				
			<div id="container">
			<div id="entir"><select id="jejsel" onchange="fu(this.value);">
						<option value="imie">Imiona</option>
						<option value="nawizska">Nazwiska</option>
						<option value="miasto">Miasta</option>
						<option value="ulice">Ulice</option>
						
					</select>	<input type="submit" id="dod" value="dodaj">
				<div class="part" id="imie">
					<table class="arg">
					
							<?php
							
						
							
							for($i=0; $i<$nri; $i++)
							{
								
$v=$imnum[$i]['imiona'];							
echo<<<EBD
<tr><td class="ag">$v</td></tr>


EBD;
							}
							
	

echo '</table></div><div class="part"  id="nawizska"><table class="arg">';
							for($i=0; $i<$nri1; $i++)
							{
								
$v=$imnum1[$i]['nazwiska'];							
echo<<<EBD
<tr><td class="ag">$v</td></tr>


EBD;

	
							}	

						
	echo '</table></div><div class="part"  id="miasto"><table class="arg">';
							for($i=0; $i<$nri2; $i++)
							{
								
$v=$imnum2[$i]['miasto'];							
echo<<<EBD
<tr><td class="ag">$v</td></tr>


EBD;

	
							}

						
	echo '</table></div><div class="part"  id="ulice"><table class="arg">';
							for($i=0; $i<$nri3; $i++)
							{
								
$v=$imnum3[$i]['ulice'];							
echo<<<EBD
<tr><td class="ag">$v</td></tr>


EBD;

	
							}								
							?>
						
				
				</table>
				</div></div>
				</div>
		</main>
	</body>
</html>