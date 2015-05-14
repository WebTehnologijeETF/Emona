<!doctype html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <link rel="stylesheet" type="text/css" href="emona1.css">
		<script src="emona.js"></script>
        <script src="ucitaj.js"></script>
		<title>Agencija "Emona"</title>
	</head>
	<body class = "body">
	


	
		<div class = "logo">
					<a href="index.php"><img src="emona.jpg" alt = "Logo"></a>	
					<p>Agencija za vještačenje, procjenu pokretne imovine i pomćne poslove u osiguranju</p>
		</div>
		
			
			<header class = "mainHeader">
				<nav>
					<ul>
						<li><a class = "active" href = "index.html">Naslovnica</a></li>
						<li><a href = "#" onclick = "return kliknuto (2,this)">Usluge</a>
							<ul id="emona2">
								<li><a href = "#" onclick ="ucitaj('usluge')">Općenito</a></li>
								<li><a href = "#" onclick ="ucitaj('vjestacenje')">Vještačenje</a></li>
								<li><a href = "#" onclick ="ucitaj('procjena')">Procjena štete</a></li>
								<li><a href = "#" onclick ="ucitaj('naplata')">Naplata štete</a></li>
							</ul>
						</li>
						<li><a href = "#" onclick ="ucitaj('onama')">O nama</a></li>
						<li><a href = "#" onclick ="ucitaj('rjecnik')">Rječnik pojmova</a></li>
						<li><a href = "#" onclick ="ucitaj('kontakt')">Kontakt</a></li>
					</ul>
					
				</nav>
			</header>
			
            <div id="sredina">
			<div class = "background">
			<div class = "maincontent">
			<div onload = "functionCoverA()" class = "backgroundpicture">
				<img alt ="cover" id = "cover" src="cover1.jpg"></img>
				<div class = "left_holder"><img alt ="lijevo" onClick = "functionCover(-1)"  src="lijevo.png"></img></div>
				<div class = "right_holder"><img alt ="desno" onClick = "functionCover(1)" src="desno.png"></img></div>
			</div>
			<div class = "topcontent">
			         <?php
                    $naziv = $_GET['naslov'];
                    echo '<h2>' .$naziv. '</h2>';
                    ?>
            
                    <p ><?php echo $_GET['detaljno'] ?></p>
                    <br>
                <p  class="post-info"><?php echo 'Autor teksta: ', $_GET['autor'] ?></p>
                <p class="post-info"><?php echo 'Datum objave: ', $_GET['datum'] ?></p>
			</div>
			</div>
			
			<aside class = "bottom-sidebar">
				<article>
					<p>Kontakt informacije</p>
					<table>
						<tr>
							<td>Tel./fax:</td>
							<td>++ 35 706 528</td>
						</tr>
						
						<tr>
							<td>GSM:</td>
							<td>061 738 272</td>
						</tr>
						
						<tr>
							<td>75320</td>
							<td>Gračanica</td>
						</tr>
						<tr>
							<td></td>
							
						</tr>
						<tr>
							<td>Ul.</td>
							<td>22. Divizije 11A</td>
						</tr>
						<tr>
							<td></td>
							<td>Bosna i Hercegovina</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</article>
			</aside>
			
			<aside class = "top-sidebar">
				<article>
					<p>Nasi partneri:</p>
					<ul>
							<li><a href="http://c2.etf.unsa.ba/course/view.php?id=119">ETF</a></li>
					</ul>
				</article>
			</aside>
			
			<aside class = "middle-sidebar">
				<article>
					<p>Da li Vam ste zadovoljni našim uslugama?</p>
					
							<input type = "radio" name = "anketa" value = "Da"> DA
							<input type = "radio" name = "anketa" value = "Ne"> NE
					
					<button type = "submit">Potvrdi</button>
				</article>
			</aside>
			
			
			
           
			<footer id = "mainfooter">
			<p>Copyright &copy; Dzenana Bricic 2015  </p>
		</footer>
		</div>	
            </div>
	</body>
</html>