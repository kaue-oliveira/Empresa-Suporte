<?php

if(!empty($_GET['idPeca']))
{
    include_once('config.php');
    
    $idPeca = intval($_GET['idPeca']); // Garantir que o ID seja um número inteiro
    
    $sqlSelect = "SELECT * FROM Peca WHERE idPeca=$idPeca";
    
    $result = $conexao->query($sqlSelect);
    
    if($result->num_rows > 0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
            $nome = $user_data['nome'];
            $tipo = $user_data['tipo'];
            $qtdDisponivel = $user_data['qtdDisponivel'];
        }
    }
    else
    {
        header('Location: visualizar.php');
        exit();
    }
}
else
{
    header('Location: visualizar.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge">
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
        #data_aluguel{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #update{
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #update:hover{
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>
<body>
    <div>
        <a href="visualizar.php">Voltar</a>
    </div>
    <div class="box">
        <form action="saveEditarbt.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Peca</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo htmlspecialchars($nome); ?>" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="tipo" id="tipo" class="inputUser" value="<?php echo htmlspecialchars($tipo); ?>" required>
                    <label for="tipo" class="labelInput">Tipo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="qtdDisponivel" id="qtdDisponivel" class="inputUser" value="<?php echo htmlspecialchars($qtdDisponivel); ?>" required>
                    <label for="qtdDisponivel" class="labelInput">Quantidade Disponível</label>
                </div>
                <br><br>
                <input type="hidden" name="idPeca" value="<?php echo htmlspecialchars($idPeca); ?>">
                <input type="submit" name="update" id="update">
            </fieldset>
        </form>
    </div>
</body>
</html>
