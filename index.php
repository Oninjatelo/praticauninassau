<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "solar";
	$conecta = mysqli_connect($servidor, $usuario, $senha, $banco);

	if (mysqli_connect_errno() ){
		die ("Conexão falhou: ". mysqli_connect_errno());
	}

	$consulta_placa = "SELECT fabricante, datasheet, preco, potencia";
	$consulta_placa .= " FROM placa";

	$placa = mysqli_query($conecta, $consulta_placa);

	if (!$placa) {
		die ("Falha na consulta ao banco de dados");
		//else {
//header("location: cliente.php");
	//	}
	}
if (isset ($_POST["cliente"])){

$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$tarifa = $_POST["tarifa"];
$jan = $_POST["jan"];
$fev = $_POST["feb"];
$mar = $_POST["mar"];
$abr = $_POST["abr"];
$mai = $_POST["mai"];
$jun = $_POST["jun"];
$jul = $_POST["jul"];
$ago = $_POST["ago"];
$sete = $_POST["sete"];
$outu = $_POST["outu"];
$nove = $_POST["nove"];
$deze = $_POST["deze"];
$cidade = $_POST["cidade"];

$inserir = "INSERT INTO clientes ";
$inserir .= " (nome,sobrenome, telefone, email, tarifa, jan, feb, mar, abr, mai, jun, jul, ago, sete, outu, nove, deze, cidade)";
$inserir .= " VALUES ('$nome', '$sobrenome', '$telefone', '$email', $tarifa, $jan, $fev, $mar, $abr, $mai, $jun, $jul, $ago, $sete, $outu, $nove, $deze, '$cidade')";

$operacao_inserir = mysqli_query($conecta, $inserir);
if (! $operacao_inserir){
	die("Falha conexao clientes");

}
}


	$cidades = "SELECT codigo, nome FROM cidades";
	$linha_estados = mysqli_query($conecta,$cidades);
	if (!$linha_estados){
		die("Erro no banco");
	}

	$fornecimento = "SELECT nome, consumo FROM fornecimento";
	$linha_fornecimento = mysqli_query($conecta,$fornecimento);
	if (!$linha_fornecimento){
		die("Erro no banco");
	}


 ?>

<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Dimensionamento de Sistemas Fotovoltaicos</title>

        <link href="css/estilo.css" rel="stylesheet" media="screen">
				<link href="css/produtos.css" rel="stylesheet" media="screen">
    </head>
<body>
	  <fieldset>
    <h2>Cadastro de novo cliente</h2>
		<div id"janela_formulario">
    <form action="index.php" method="post">
    Nome: <input type="text" name="nome"  size="30" placeholder="Nome"><br>
    Sobrenome: <input type="text" name="sobrenome" size="30" placeholder="Sobrenome"><br>
    Telefone: <input type="text" name="telefone" size="30" placeholder="Telefone"><br>
    E-mail: <input type="text" name="email" size="30"placeholder="E-mail" ><br>
    <br>
    Tarifa do kWH: <input type="text" name="tarifa" size="5"><br>
    <br>
    Insira o consumo do último ano (kWH):<br>
    Janeiro: <input type="text" name="ja" size="4"><br>
    Fevereiro: <input type="text" name="fev" size="4"><br>
    Março: <input type="text" name="mar" size="4"><br>
    Abril: <input type="text" name="abr"size="4" ><br>
    Maio: <input type="text" name="mai" size="4"><br>
    Junho: <input type="text" name="jun" size="4"><br>
    Julho: <input type="text" name="jul" size="4"><br>
    Agosto: <input type="text" name="ago" size="4"><br>
    Setembro: <input type="text" name="sete" size="4"><br>
    Outubro: <input type="text" name="Outu"size="4" ><br>
    Novembro: <input type="text" name="Nove"size="4" ><br>
    Dezembro: <input type="text" name="Deze" size="4"><br>
    </form>
    Selecione a cidade: <select name="cidade" id="cidade">
<?php while($linha = mysqli_fetch_assoc($linha_estados)) {
?>
			<option value="<?php echo $linha ["codigo"];?>">
<?php echo $linha ["nome"];

?>
			</option>
<?php } ?>
<br>
Selecione o consumo: <select name="fornecimento" id="fornecimento">
<?php while($linha2 = mysqli_fetch_assoc($linha_fornecimento)) {
?>
	<option value="<?php echo $linha2 ["codigo"];?>">
<?php echo $linha2 ["nome"];

?>
	</option>
<?php } ?>
    </select><br>

    Selecione a placa: <select name="placa" id="placa">
      <option value="100W">Placa 100W</option>
      <option value="500W">Placa 500W</option>
    </select><br>

			</div>
		<main>


			<div id="listagem_produtos">
				<?php
					while ($registro = mysqli_fetch_assoc ($placa)) {
						?>
						<ul>
							<li>Fabricante: <?php echo $registro["fabricante"]?></li>
							<li>Datasshet: <?php echo $registro["datasheet"]?></li>
							<li>Preço (R$): <?php echo number_format($registro["preco"], 2, "," , ".") ?></li>
							<li>Potência (W): <?php echo $registro["potencia"]?></li>
						</ul>
						<?php
						}
				?>
				<?php
					mysqli_free_result($placa);
				 ?>
			 </div>
		 </main>
<br>
    Selecione seu padrão de fornecimento: <select name="fornecimento" id="fornecimento">
      <option value="monofasico">Monofásico</option>
      <option value="bifasico">Bifásico</option>
      <option value="trifasico">Trifásico</option>
    </select><br>
    <br>
    <input type="submit" value="Enviar" size="30">
    <br>
    <br>
    <a href="teladmin.html">Entrar na área do administrador</a>
  </form>
</fieldset>
</body>
</html>

<?php
	mysqli_close($conecta);
 ?>
