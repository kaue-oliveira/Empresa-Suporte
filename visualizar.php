<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('config.php');

// Verificar a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

if(!empty($_GET['search']))
{
    $data = $_GET['search'];
    $sql = "SELECT * FROM Peca WHERE idPeca LIKE '%$data%' OR nome LIKE '%$data%' OR tipo LIKE '%$data%' OR qtdDisponivel LIKE '%$data%' ORDER BY idPeca DESC";
}
else
{
    $sql = "SELECT * FROM Peca ORDER BY idPeca DESC";
}

// Executar a consulta 
$result = $conexao->query($sql);
if (!$result) {
    die("Erro na consulta: " . $conexao->error);
}

if ($result->num_rows == 0) {
    echo "Nenhum resultado encontrado.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Visualizar Pecas</title>
    <style type="text/css">
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .primeiro{
            background-color: dodgerblue;
            position: absolute;
            width:100.5%;
            height:60px;
            margin-top: 0px;
            margin-left: -8px;    
        }
        h1{
            font-family: arial;
            font-size:20px;
            color: white;
            margin-left:10px;
            margin-top:15px;
            font-weight: bold;
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius:0 0 0 0;
            text-align: center;
        }
        .d-flex{
            margin-left:93%;
            margin-top:-2.75%;
        }
        .box-search{
            display: flex;
            justify-content: center;
            gap: .2%;
        }
        .form-control{
            outline: none;
            border-radius: 5px;
            border:none;
        }
    </style>
</head>
<body>
    <div class = "primeiro">
        <h1>ㅤDados das Pecas</h1>
        <div class = "d-flex">
            <a href="inicial.html" class="btn btn-danger me-5">Voltar</a>
        </div>
    </div>
    <br><br><br>
    <div class = "box-search m-3">
        <input type = "search" class = "form-control w-25" placeholder = "Pesquisar" id = "pesquisar">
        <button onclick="searchData()" class="btn btn-primary ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class = "m-4">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Quantidade Disponível</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($user_data = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>".$user_data['idPeca']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['tipo']."</td>";
                        echo "<td>".$user_data['qtdDisponivel']."</td>";
                        echo "<td>
                                <a class='btn btn-sm btn-primary' href='editarbt.php?idPeca=$user_data[idPeca]'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                        <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                    </svg>
                                </a>
                                <a class='btn btn-sm btn-danger' href='deletebt.php?idPeca=$user_data[idPeca]'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                        <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/>
                                    </svg>
                                </a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum dado encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');
    
    search.addEventListener("keydown", function(event){
        if(event.key === "Enter")
        {
            searchData();
        }
    });
    function searchData()
    {
        window.location = 'visualizar.php?search='+search.value;
    }
</script>
</html>