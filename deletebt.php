<?php


if(!empty($_GET['idPeca']))
{
   include_once('config.php');
 
 
   $sqlSelect = "SELECT * FROM Peca WHERE idPeca = $id";
 
   $result = $conexao->query($sqlSelect);
 
   if($result->num_rows > 0)
   {
   	$sqlDelete = "DELETE FROM Peca WHERE idPeca = $id";
   	$resultDelete = $conexao->query($sqlDelete);
   }
}


header('Location: visualizar.php');


?>







