<?php
    // Configurações do banco de dados
    $dbHost = 'localhost';  // Corrigido para minúsculas
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'SuporteTech';
    
    // Cria a conexão com o banco de dados
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    // Verifica se houve um erro na conexão
   // if ($conexao->connect_errno) {
        // Exibe uma mensagem de erro
     //   echo "Erro na conexão com o banco de dados: " . $conexao->connect_error;
    //} else {
        // Mensagem de sucesso (opcional)
     //   echo "Conexão efetuada com sucesso";
    //}
?>
