<?php
session_start();
// Inclui a conexão com o banco de dados e o model
include '../model/ProdutoModel.php';
include '../settings/config.php';
// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
} else {
  //echo "<script>alert('Conexão com o banco de dados estabelecida com sucesso!');</script>";
}
// Cria a instância do model com a conexão
$model = new ProdutoModel($conn);

// Verifica se o usuário clicou no botão de logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php"); // Redireciona para a página de login após o logout
    exit;
}

// Busca os produtos do model
$ofertas_do_dia = $model->getOfertasDoDia();  // Busca ofertas do dia
$top_vendidos = $model->getMaisVendidos();    // Busca os mais vendidos

// Debug temporário para verificar se a consulta retornou algo
if ($ofertas_do_dia && $ofertas_do_dia->num_rows > 0) {
   // echo "Tem ofertas!";
} else {
    echo "Nenhuma oferta encontrada.";
}

// Incluir a view que vai exibir os produtos
include '../view/pagina.php';
?>
