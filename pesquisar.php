<?php
include_once("php/conexao.php");
require("php/utils.php");

$sql = "SELECT * FROM Cliente WHERE ".strtolower($_GET["campo"])." LIKE '%".$_GET["pesquisa"]."%';";
$result = $conn->query($sql);
$sql1 = "SELECT * FROM Cliente INNER JOIN Endereco ON Cliente.cep = Endereco.cep INNER JOIN cidade ON Endereco.cod_cidade = Cidade.cod_cidade INNER JOIN Estado ON Cidade.cod_estado = Estado.cod_estado";
$result1 = $conn->query($sql1);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
  <title>Crud</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="index.html">Cadastrar Cliente &nbsp; |</a>
    <a class="navbar-brand" href="listar.php">Clientes Cadastrados &nbsp; |</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="#">Matteo Martins & Vinicius Pereira<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="pesquisar.php">
      <input class="form-control mr-sm-2" name="pesquisa" type="search" placeholder="Buscar Cliente" aria-label="Search">
      <select class="form-control mr-sm-2" name="campo" id="exampleFormControlSelect1">
        <option>Nome</option>
        <option>Email</option>
        <option>Telefone</option>
        <option>CPF</option>
        <option>RG</option>
      </select>
      <button class="btn btn-dark my-2 my-sm-2" type="submit">Buscar</button>
    </form>
  </div>
</nav>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Telefone</th>
      <th scope="col">Sexo</th>
      <th scope="col">CPF</th>
      <th scope="col">RG</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>".$row["id_cliente"]."</td>";
      echo "<td>".$row["nome"]." ".$row["sobrenome"]."</td>";
      echo "<td>".$row["email"]."</td>";
      echo "<td>".$row["telefone"]."</td>";
      echo "<td>".$row["sexo"]."</td>";
      echo "<td>".$row["cpf"]."</td>";
      echo "<td>".$row["rg"]."</td>";
      echo "<td><a href='' data-toggle='modal' data-target='#Modal".$row["id_cliente"]."'>Ver mais</a></td>";
      echo "</tr>";
    }
  } else {

    echo "  </tbody>
</table>
<h3>Sem resultados...</h3>";
  }
?>
  </tbody>
</table>
<?php
  if ($result1->num_rows > 0) {
  // output data of each row
    while($row = $result1->fetch_assoc()){
      $guarda = $row["guarda_religiosa"]=='1'?'Sim':'Não';
      $sexo = $row["sexo"]=='M'?'Masculino':'Feminino';

      echo '<div class="modal fade" id="Modal'.$row["id_cliente"].'" tabindex="-1" role="dialog">';
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">';
      echo '<div class="modal-header">';
      echo '<h5 class="modal-title">'.$row["nome"]." ".$row["sobrenome"].'</h5>';
      echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button> </div>';
      echo '<div class="modal-body">';
      echo '<p><b>Telefone: </b>'.$row["telefone"].'</p>';
      echo '<p><b>Email: </b>'.$row["email"].'</p>';
      echo '<p><b>CPF: </b>'.$row["cpf"].'</p>';
      echo '<p><b>RG: </b>'.$row["rg"].'</p>';
      echo '<p><b>Data de Nascimento: </b>'.$row["data_nascimento"].'</p>';
      echo '<p><b>Sexo: </b>'.$sexo.'</p>';
      echo '<p><b>Guarda Religiosa: </b>'.$guarda.'</p>';
      echo '<p><b>Observação: </b>'.$row["obs"].'</p>';
      echo '<p><b>Estado: </b>'.$row["estado"].'</p>';
      echo '<p><b>Cidade: </b>'.$row["cidade"].'</p>';
      echo '<p><b>Bairro: </b>'.$row["bairro"].'</p>';
      echo '<p><b>Logradouro: </b>'.$row["logradouro"].'</p>';
      echo '<p><b>CEP: </b>'.$row["cep"].'</p>';
      echo '<p><b>Numero: </b>'.$row["numero"].'</p>';
      echo '</div></div></div></div>';
    }
  }
?>

</body>
</html>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
