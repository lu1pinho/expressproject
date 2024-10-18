<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../view/vendedor/modular/sidebar/sidebar.css">
  <title>Página do Vendedor</title>
  <style>
     @font-face {
    font-family: 'Inter';
    src: url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    font-display: swap; }

    .container {
      margin-left: 280px;
      margin-top: 30px;/
    }
    .container h2 {
      font-family: 'Inter';
      font-weight: normal;
    }
  </style>
</head>
<body>
<?php include_once 'C:\xampp\htdocs\expressproject\view\vendedor\modular\sidebar\include_sidebar.php'; ?>
<?php include 'C:\xampp\htdocs\expressproject\settings\connection.php'; ?>

<div class="container" >
  <h2>Que bom te ver, <?php echo $_SESSION['nome']; ?></h2>
  <p>Confira as atualizações do seu negócio</p>
</div>
</body>
</html>