
<?php
    // tabela de transportadoras

    	$servidor = "localhost";
    	$usuario = "root";
    	$senha = "";
    	$banco = "solar";
    	$conecta = mysqli_connect($servidor, $usuario, $senha, $banco);

    	if (mysqli_connect_errno() ){
    		die ("Conexão falhou: ". mysqli_connect_errno());
    	}

    	$consulta_clientes = "SELECT nome, sobrenome, telefone, email, cidade";
    	$consulta_clientes .= " FROM clientes";

    	$placa = mysqli_query($conecta, $consulta_clientes);

    	if (!$placa) {
    		die ("Falha na consulta ao banco de dados");
    		//else {
    //header("location: cliente.php");
    	//	}
    	}

    $tr = "SELECT * FROM clientes";
    $consulta_tr = mysqli_query($conecta, $tr);
    if(!$consulta_tr) {
        die("erro no banco");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>

        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/novo-transportadora.css" rel="stylesheet">
    </head>

    <body>


        <main>
            <nav>
                <a>Dados Clientes</a>
            </nav>

            <div id="dadosclientes">
                <?php
                    while($linha = mysqli_fetch_assoc($consulta_tr)) {
                ?>
                <ul>
                    <li>Nome: <?php echo $linha["nome"] ?></li>
                    <li>Sobrenome: <?php echo $linha["sobrenome"] ?></li>
                    <li>Telefone: <?php echo $linha["telefone"] ?></li>
                    <li>E-mail: <?php echo $linha["email"] ?></li>
                    <li>Tarifa: <?php echo $linha["tarifa"] ?></li>
                    <li>Cidade: <?php echo $linha["cidade"] ?></li>
                </ul>
                <?php
                    }
                ?>
            </div>
        </main>


    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>
