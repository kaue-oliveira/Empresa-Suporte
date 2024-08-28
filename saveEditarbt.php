<?php

include_once('config.php');

if(isset($_POST['update']))
{
    $idPeca = intval($_POST['idPeca']); // Garantir que o ID seja um número inteiro 
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $qtdDisponivel = intval($_POST['qtdDisponivel']); // Garantir que a quantidade seja um número 
    
    // Atualizar a Peca na tabela
    $sqlUpdate = "UPDATE Peca SET nome='$nome', tipo='$tipo', qtdDisponivel='$qtdDisponivel'
    WHERE idPeca='$idPeca'";
    
    $result = $conexao->query($sqlUpdate);
}

header('Location: visualizar.php');

?>
