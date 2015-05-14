<?php

$primjer = "";
$brojac=0;
$noveVijesti = array();
/*ucitavanje vijesti*/
foreach(glob("vijesti/*.txt") as $nazivVijesti)
{
    $noveVijesti[$brojac] = file($nazivVijesti);
    $brojac++;
}

$brojVijesti=count($noveVijesti);


for ($i = 0; $i < $brojVijesti; $i++)
{
    for ($j = 0; $j < $brojVijesti - 1 - $i; $j++) {
        $time1 = strtotime($noveVijesti[$j][0]); $newformat1 = date('d-m-Y h:i:s',$time1);
        $time2 = strtotime($noveVijesti[$j+1][0]); $newformat2 = date('d-m-Y h:i:s',$time2);
        if ($time2 < $time1) {
            $tmp=$noveVijesti[$j];
            $noveVijesti[$j]=$noveVijesti[$j+1];
            $noveVijesti[$j+1]=$tmp;
        }
    }
}

for ($i=0; $i<$brojVijesti; $i++)
{
    $vijestDuzina=count($noveVijesti[$i]);
    $sadrzajnoveVijesti=$detaljnijenoveVijesti="";
    $j=4;
    while ($j<$vijestDuzina){
        if (trim($noveVijesti[$i][$j])=="--"){
            for ($k=$j+1; $k<$vijestDuzina; $k++){
                $detaljnijenoveVijesti.=$noveVijesti[$i][$k];
            }
            break;
        }
        $sadrzajnoveVijesti.=$noveVijesti[$i][$j];
        $j++;
    }
    $datum=$noveVijesti[$i][0]; $autor=$noveVijesti[$i][1]; $naslov=$noveVijesti[$i][2]; 

    if (empty($detaljnijenoveVijesti))
    {
        $vidljivost = 'display: none';
    }
    else
    {
        $vidljivost = 'display: block';
    }
   $primjer .= "
        <form method='get' action='vijesti.php'>
            <div class='topcontent'>
                <input type='hidden' name='autor' value='$autor'>
                <input type='hidden' name='naslov' value='$naslov'>
                <input type='hidden' name='sadržaj' value= '$sadrzajnoveVijesti'>
                <input type='hidden' name='datum' value='$datum'>
                <input type='hidden' name='detaljno' value='$detaljnijenoveVijesti'>
                <h3 class='naslov'>$naslov</h3>
                <p>$sadrzajnoveVijesti</p>
                <br>
                <p class='post-info'><span> $autor,  $datum  </span> 
                <input style='$vidljivost' class = 'post-info' type='submit' id='submitButton4' value='Detaljnije>>'>
            </div>
        </form>";
}

echo <<<_HTML_
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
						<li><a class = "active" href = "index.php">Naslovnica</a></li>
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
			<div class = "content">
					$primjer
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
_HTML_;
?>

