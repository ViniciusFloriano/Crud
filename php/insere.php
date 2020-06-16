<?php

include_once("conexao.php");
require("utils.php");

$nome = $_GET['nome'];
$email = $_GET['email'];
$sobrenome = $_GET['sobrenome'];
$cep = $_GET['cepa'];
$numero = $_GET['num'];
$data_nascimento = $_GET['dtnasc'];
$cpf = $_GET['cpf'];
$rg = $_GET['rg'];
$guarda_religiosa = $_GET['g_r'];
$obs = $_GET['obs'];
$telefone = $_GET['telefone'];
$sexo = $_GET['sexo'];
$estado = $_GET['estado'];
$cidade = $_GET['cidade'];
$logradouro = $_GET['endereco'];
$bairro = $_GET['bairro'];

$query_estado = 'SELECT cod_estado FROM Estado WHERE uf = "'.$estado.'" ORDER BY cod_estado DESC LIMIT 1';
if($result_query_estado = mysqli_query($conn, $query_estado)->fetch_assoc()) {
    $cod_estado = $result_query_estado['cod_estado'];
}
else {
    $result_estado = 'INSERT INTO Estado (uf, estado) VALUES ("'.$estado.'", "'.$estados[$estado].'")';
    $resultado_estado = mysqli_query($conn, $result_estado);
    
    $query_estado = 'SELECT cod_estado FROM Estado ORDER BY cod_estado DESC LIMIT 1';
    $result_query_estado = mysqli_query($conn, $query_estado);
    $cod_estado = $result_query_estado->fetch_assoc()['cod_estado'];    
}

$query_cidade = 'SELECT cod_cidade FROM Cidade WHERE cidade = "'.$cidade.'" ORDER BY cod_cidade DESC LIMIT 1';
if($result_query_cidade = mysqli_query($conn, $query_cidade)->fetch_assoc()){
    $cod_cidade = $result_query_cidade['cod_cidade'];
}
else{
    $result_cidade = 'INSERT INTO Cidade (cidade, cod_estado) VALUES ("'.$cidade.'", "'.$cod_estado.'")';
    $resultado_cidade = mysqli_query($conn, $result_cidade);
    
    $query_cidade = 'SELECT cod_cidade FROM Cidade ORDER BY cod_cidade DESC LIMIT 1';
    $result_query_cidade = mysqli_query($conn, $query_cidade);
    $cod_cidade = $result_query_cidade->fetch_assoc()['cod_cidade'];    
}

$query_endereco = 'SELECT cep FROM Endereco WHERE cep = "'.$cep.'" LIMIT 1';
if(!$result = mysqli_query($conn, $query_endereco)->fetch_assoc()){
    $result_endereco = 'INSERT INTO Endereco (cep, logradouro, bairro, cod_cidade) VALUES ("'.$cep.'", "'.$logradouro.'", "'.$bairro.'", '.$cod_cidade.')';
    $resultado_endereco = mysqli_query($conn, $result_endereco);
}
$query_usuario = 'SELECT cpf FROM Cliente WHERE cpf = "'.$cpf.'" LIMIT 1';
if(!$result = mysqli_query($conn, $query_usuario)->fetch_assoc()){
    $result_usuario = 'INSERT INTO Cliente (nome,sobrenome,cep, numero,sexo,data_nascimento,cpf,rg,guarda_religiosa,obs,telefone,email) VALUES ("'.$nome.'","'.$sobrenome.'","'.$cep.'",'.$numero.',"'.$sexo.'","'.$data_nascimento.'","'.$cpf.'","'.$rg.'","'.$guarda_religiosa.'","'.$obs.'","'.$telefone.'", "'.$email.'")';
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    echo("<script>alert('Usuário cadastrado com sucesso!'); window.location.href='../index.html'</script>");
}
else {
    echo("<script>alert('cpf já cadastrado'); window.location.href='../index.html'</script>");
}

$conn->close();
?>