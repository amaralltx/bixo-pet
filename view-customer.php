<?php
require 'config/config.php' ;
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bixo Espaço Pet - CRUD</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/view.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  </head>
  <body>
    <a class="return-arrow" href="index.php">
      voltar
    </a>
    <div class="container">
      <div class="background-card">
      </div>
      <div class="user-card">
        <div class="right-card">
          <div class="card-header">
                <img src="assets/images/user.png" alt="">
                <h2>Cliente</h2>
          </div>
          <div class="card-body">
          <?php
            $sql = 'SELECT * FROM clientes WHERE id_cliente = ' . $_GET['id'];
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $customer = mysqli_fetch_assoc($result); // Extrai os dados como um array associativo
            } else {
                $customer = null; // Define como null caso não encontre resultados
            }
          ?>
          <!-- TODO: se tiver tempo, adicionar a última atualização feita no perfil do cliente -->
            <div class="card-content">
              <h3>Nome: </h3>
              <p><?= $customer ? $customer['nome'] : 'Cliente não encontrado' ?></p>
            </div>
            <div class="card-content">
              <h3>Telefone: </h3>
              <p><?= $customer ? $customer['telefone'] : 'Cliente não encontrado' ?></p>
            </div>
            <div class="card-content">
              <h3>E-mail: </h3>
              <p><?= $customer ? $customer['email'] : '' ?></p>
            </div>
          </div>
        </div>
        <div class="left-card">
          <div class="card-header">
            <img src="assets/images/paw.png" alt="">
            <h2>Pet</h2>
          </div>
          <div class="card-body">
            <div class="card-content">
              <h3>Nome: </h3>
              <p><?= $customer ? $customer['nome_pet'] : 'Pet não encontrado' ?></p>
            </div>
            <div class="card-content">
              <h3>Espécie: </h3>
              <p><?= $customer ? $customer['especie'] : '' ?></p>
            </div>
            <div class="card-content">
              <h3>Raça: </h3>
              <p><?= $customer ? $customer['raca'] : '' ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="user-last-update">
        <p>Última atualização &nbsp;- &nbsp;<?= $customer ? $customer['ultima_atualizacao'] : '' ?></p>
      </div>
    </div>
    <?php include 'components/footer.php'; ?>
  </body>
</html>