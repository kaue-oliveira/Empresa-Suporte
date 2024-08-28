<?php
if(isset($_POST['submit']))
{
    include_once('config.php');
    
    // validação dos dados de entrada
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);
    $qtdDisponivel = filter_var($_POST['qtdDisponivel'], FILTER_VALIDATE_INT);
    
    if($qtdDisponivel === false || $qtdDisponivel < 0) {
        $erro = "Quantidade inválida. Por favor, insira um número inteiro positivo.";
    } else {
        // Usando prepared statement (segurança????)
        $stmt = $conexao->prepare("INSERT INTO Peca (nome, tipo, qtdDisponivel) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nome, $tipo, $qtdDisponivel);
        
        if($stmt->execute()) {
            $sucesso = "Peça cadastrada com sucesso!";
        } else {
            $erro = "Erro ao cadastrar peça: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | BT</title>
    <style type="text/css">
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #submit{
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <a href="inicial.html">Voltar</a>
    <div class="box">
        <?php
        if(isset($sucesso)) {
            echo "<div class='message success'>$sucesso</div>";
        }
        if(isset($erro)) {
            echo "<div class='message error'>$erro</div>";
        }
        ?>
        <form action="formulariobt.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Peça</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="tipo" id="tipo" class="inputUser" required>
                    <label for="tipo" class="labelInput">Tipo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="qtdDisponivel" id="qtdDisponivel" class="inputUser" required>
                    <label for="qtdDisponivel" class="labelInput">Quantidade Disponível</label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>