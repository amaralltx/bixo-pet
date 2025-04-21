<?php
require 'config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bixo Espaço Pet - CRUD</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/container.css">
  <link rel="stylesheet" href="css/table.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
  <?php include 'components/header.php'; ?>

  <?php include 'components/container.php'; ?>

  <?php include 'components/footer.php'; ?>

  <script>
    // Adiciona um event listener para mostrar o formulário de adicionar cliente
    document.querySelector("#add_btn").addEventListener("click", function() {
      // Seleciona os elementos do DOM que aparecem e desaparecem
      var formContainer = document.querySelector(".register-container");
      var btnCancel = document.querySelector("#cancel_btn");
      var btnAdd = document.querySelector("#add_btn");
      var btnSave = document.querySelector("#save_btn");
      var tabela = document.querySelector(".div-table");
      // Altera o css, mostrando o formulário para adicionar um novo cliente
      // Timeout por causa da animação de transição que tava feia
      setTimeout(() => (btnCancel.style.display = "inline"), 100);
      setTimeout(() => (btnSave.style.display = "inline"), 100);
      setTimeout(() => (btnAdd.style.display = "none"), 100);
      setTimeout(() => (formContainer.style.maxHeight = "500px"), 100);
      setTimeout(() => (tabela.style.borderRadius = "0 0 5px 5px"), 100);
    });
    // Basicamente o inverso do anterior, mas para o botão de cancelar, escondendo o formulário
    document
      .querySelector("#cancel_btn")
      .addEventListener("click", function() {
        var formContainer = document.querySelector(".register-container");
        var btnCancel = document.querySelector("#cancel_btn");
        var btnAdd = document.querySelector("#add_btn");
        var btnSave = document.querySelector("#save_btn");
        var tabela = document.querySelector(".div-table");
        setTimeout(() => (formContainer.style.maxHeight = "0"), 100);
        setTimeout(() => (btnCancel.style.display = "none"), 100);
        setTimeout(() => (btnSave.style.display = "none"), 100);
        setTimeout(() => (btnAdd.style.display = "inline"), 100);
        setTimeout(() => (formContainer.style.marginBottom = "0px"), 100);
        tabela.style.borderRadius = "5px";
      });
  </script>
  <script>
      // Adiciona um event listener que ativa quando o DOM carrega
      document.addEventListener("DOMContentLoaded", function() {
        // Seleciona o campo de busca e a tabela
        const searchInput = document.getElementById("search-input");
        const tableBody = document.querySelector(".crud-table tbody");
        // Adiciona um listener para quando o usuário digitar no campo de busca
        searchInput.addEventListener("input", function() {
          const query = searchInput.value; //valor atual do campo de busca

          const xhr = new XMLHttpRequest();
          // Define a requisição como um GET para o arquivo PHP com a query na URL
          xhr.open("GET", `components/search.php?busca=${encodeURIComponent(query)}`, true);
          xhr.onload = function() {
            // Atualiza a tabela com o retorno do PHP se a requisição der certo
            if (xhr.status === 200) {
              tableBody.innerHTML = xhr.responseText;
            }
          };
          xhr.send();
        });
      });
  </script>

</body>

</html>