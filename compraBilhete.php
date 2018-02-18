<?php 

	session_start();
	require_once 'funcoes.php'; 
	$con = conectar();

	$rifa_id = $_POST['id'];
	$titulo = $_POST['titulo'];

	$sucessoDefine = defineNumero($con, $rifa_id);
	$limiteDefine = limiteBilhete($con, $rifa_id);

	$query = defineNumero($con, $rifa_id);
	while ($registro1 = mysqli_fetch_assoc($query)) {
		$numero = $registro1['numero'];
		$qtde = $registro1['quantidade_bilhetes'];
	}

	$query = limiteBilhete($con, $rifa_id);
	while ($registro2 = mysqli_fetch_assoc($query)) {
		$limite = $registro2['limite'];
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Senhor das Rifas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/cadastroLogin.css">
</head>
<body>
	<header>
		<h1>Senhor das Rifas</h1>
		<nav>
			<ul>
				<li class="borda"><a href="index.php">Home</a></li>
				<li class="borda"><a href="rifas.php">Rifas</a></li>
				<li class="borda"><a href="minhasRifas.php">Minhas Rifas</a></li>
				<li class="borda"><a href="criaRifa.php">Criar Rifa</a></li>
			</ul>
		</nav>
		<h2>Soluções inteligentes para o gerenciamento de rifas</h2>

		<?php
		if(isset($_SESSION["nome"])){
				?>

		<nav class="navi">
			<ul class="cor">
				<li >Seja bem-vindo, <a href="telaUser.php"><?=$_SESSION["nome"]?>!</a></li>
				<li><a href="login.php">Sair</a></li>
			</ul>
		</nav>

		<?php
			}else{
		?>
		<nav class="navi">
			<ul class="cor">
				<li >Faça agora o seu <a href="login.php">login</a></li>
			</ul>
		</nav>
		<nav class="navig">
			<ul class="cor">
				<li >Ainda não é cadastrado? <a href="cadastro.php">Cadastre-se agora!</a></li>
			</ul>
		</nav>
		<?php
			}
		?>
	</header>
	<main>

		<?php
			if($limite>=$qtde){
				echo "<h2>O número limite de bilhetes já foi comprado, escolha outra rifa! O próximo bilhete seria o $limite bilhete e o limite é de $qtde bilhetes</h2>";
			}else{
				$sucesso = compraBilhete($con, $rifa_id, $_SESSION['id'], $numero);
				if($sucesso){
					echo "<h2>Parabéns, você comprou o bilhete número $numero!</h2>";
				}else{
					echo "<h2>Erro ao comprar um bilhete!</h2>";
				}
			}
		?>

		
		
	</main>
	<footer class="footeiro">
		<div>Junte-se agora ao melhor site nacional de gerenciamento de rifas!  </div>
	</footer>
</body>
</html>