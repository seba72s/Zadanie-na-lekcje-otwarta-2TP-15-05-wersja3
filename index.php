<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Analiza sprzedaży</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
	require_once(__DIR__.'/Payments.php');
	$payments = new Payments();
	if (isset($_POST['firstname'])) {$firstName = $_POST['firstname'];} else {$firstName = null;}
	if (isset($_POST['lastname'])) {$lastName = $_POST['lastname'];} else {$lastName = null;}
?>
	<div class="main">
		<div class="banner">
			<h1 class="naglowek1">
				MY MARKET
			</h1>
			<h3 class="naglowek2">
				 - analiza sprzedaży sklepu internetowego
			</h3>
		</div>
		<div class="orders">
			<div class="lewy">
				<h3 class="titles">Analiza zamówień</h3>
				<hr>
				<form action="index.php" method="POST">
				<label for="firstname">Podaj imię</label>
				<input type="text" name="firstname" ><br>
				<label for="lastname">Podaj nazwisko</label>
				<input type="text" name="lastname" ><br>
				<input type="submit" name="submit" value="pokaż">
				</form>
			</div>
				<div class="prawy">
					<h3 class="titles">Zamówienia</h3>
					<hr>
					
				</div>
			</div>
			<div class="payments">
				<div class="lewy">
					<h3 class="titles">Analiza płatności</h3>
					<hr>
					<p>Wartość towarów: </p>
					<p>Kwota płatnosci: </p>
				</div>
				<div class="prawy">
					<h3 class="titles">Płatności</h3>
					<hr>
					<?php
					echo $payments->getSqlComplited2($firstName, $lastName);
					?>
				</div>
			</div>
		<div class="stopka">
			<div class="stopkal">
				<p>Autorem aplikacji jest: 0000000000000000</p>
				<ul>
					<li>Skontaktuj się</li>
					<li>Poznaj naszą firmę</li>
				</ul>
			</div>
			<div class="stopkap">
				<img src="logo.png" alt="logo">
			</div>
		</div>
	</div>
</body>
</html>
