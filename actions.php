<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log'); // cria um arquivo no mesmo diretório

session_start();
require 'config/config.php';
require 'create_log.php';

### CREATE ###
// Verifica se o botão de salvar foi clicado
if (isset($_POST['save_user_btn'])) {
    
    // Recebe os dados enviados pelo formulário e remove espaços em branco no início e no fim com trim
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $nomepet = trim($_POST['nome_pet']);
    $especie = trim($_POST['especie']);
    $raca = trim($_POST['raca']);

    // Prepara a query SQL para inserir os dados na tabela clientes, valores são placeholders
    $sql = "INSERT INTO clientes (nome, telefone, email, nome_pet, especie, raca) VALUES (?, ?, ?, ?, ?, ?)";

    // Inicializa o statement
    $stmt = mysqli_prepare($link, $sql);
    // ssssss porque todos parâmetros são strings
    mysqli_stmt_bind_param($stmt, "ssssss", $nome, $telefone, $email, $nomepet, $especie, $raca);

    // Executa a query preparada e verifica se houve erro
    if (!mysqli_stmt_execute($stmt)) {
        die("Erro ao executar a query: " . mysqli_stmt_error($stmt));
    }

    // Retorna o ID inserido na tabela
    $novo_id = mysqli_insert_id($link);

    $dados_novos = [
        "nome" => $nome,
        "telefone" => $telefone,
        "email" => $email,
        "nome_pet" => $nomepet,
        "especie" => $especie,
        "raca" => $raca
    ];
    // Converte pra JSON
    $dados_novos = json_encode($dados_novos, JSON_UNESCAPED_UNICODE);

    create_log("INSERT", $novo_id, NULL, $dados_novos);

    // TODO: se tiver tempo, exibir mensagem de sucesso/erro na tela
    // Verifica se alguma linha foi afetada e personaliza a mensagem de sucesso ou erro
    if (mysqli_affected_rows($link) > 0) {
        $_SESSION['message'] = 'Cliente cadastrado com sucesso!';
        header('Location: index.php');
    } else {
        $_SESSION['message'] = 'Erro ao cadastrar o cliente';
        header('Location: index.php');
    }


    // Fecha o statement e encerra a conexão com o banco
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}


// Verifica se o botão de deletar foi clicado
if (isset($_POST['delete_user'])) {

    $id_cliente = mysqli_real_escape_string($link, $_POST['delete_user']);

    // Busca os dados antigos antes de deletar para o log
    $stmt = mysqli_prepare($link, "SELECT * FROM clientes WHERE id_cliente = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    // Prepara a query SQL para deletar o cliente com base no ID
    $sql = "DELETE FROM clientes WHERE id_cliente = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);

    // Executa o statement e verifica se deu erro
    if (!mysqli_stmt_execute($stmt)) {
        die("Erro ao executar a query: " . mysqli_stmt_error($stmt));
    }

    // Mensagem de sucesso ou erro
    if (mysqli_affected_rows($link) > 0) {
        $_SESSION['message'] = 'Cliente deletado com sucesso!';
        // Registra o log da exclusão com os dados antigos
        $dados_antigos = mysqli_fetch_assoc($result);
        $dados_antigos = json_encode($dados_antigos, JSON_UNESCAPED_UNICODE);
        create_log("DELETE", $id_cliente, $dados_antigos, NULL);

    } else {
        $_SESSION['message'] = 'Erro ao deletar o cliente';
    }

    header('Location: index.php');

    // Fecha o statement e encerra a conexão
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}


### UPDATE ###
// Verifica se o botão de atualizar o cliente foi pressionado 
if (isset($_POST['update_user'])) {
    // Lista dos campos via POST
    $campos = ['nome', 'telefone', 'email', 'nome_pet', 'raca', 'especie'];
    $dados = [];
    $id_cliente = $_POST['update_user'];

    // Busca os dados antigos antes de atualizar para o log
    // Como nem sempre todos os campos são atualizados, optei por fazer uma busca completa antes
    $stmt = mysqli_prepare($link, "SELECT * FROM clientes WHERE id_cliente = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $dados_antigos = mysqli_fetch_assoc($result);
    $dados_antigos = json_encode($dados_antigos, JSON_UNESCAPED_UNICODE);

    // Loop pelos campos
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            // Remove espaços em branco do início e fim
            $valor = trim($_POST[$campo]);

            // Ignora se estiver vazio
            if ($valor === '') {
                continue;
            }
            // Tratamento específico para o campo 'especie' porque é um select
            if ($campo === 'especie' && $valor === '--') {
                continue;
            }
            // Aplica a sanitização para evitar injeção SQL
            $dados[$campo] = mysqli_real_escape_string($link, $valor);
        }
    }

    $sql = "UPDATE clientes SET ";
    $set = [];
    // Para cada campo preenchido, adiciona ao array $set
    foreach ($dados as $campo => $valor) {
        $set[] = "$campo = '$valor'";
    }
    // Concatena os campos para a query
    $sql .= implode(", ", $set);
    // Adiciona a condição WHERE para o ID do cliente
    $sql .= " WHERE id_cliente = ?";

    // Prepara o statement
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);

    if (!mysqli_stmt_execute($stmt)) {
        die("Erro ao executar a query: " . mysqli_stmt_error($stmt));
    }

    // Verifica se alguma linha foi afetada e personaliza a mensagem de sucesso ou erro
    if (mysqli_affected_rows($link) > 0) {
        // Busca os dados atualizados
        $stmt = mysqli_prepare($link, "SELECT * FROM clientes WHERE id_cliente = ?");
        mysqli_stmt_bind_param($stmt, "i", $id_cliente);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $dados_novos = mysqli_fetch_assoc($result);
        $dados_novos = json_encode($dados_novos, JSON_UNESCAPED_UNICODE);

        create_log("UPDATE", $id_cliente, $dados_antigos, $dados_novos);
        
        $_SESSION['message'] = 'Cliente atualizado com sucesso!';
        header('Location: index.php');
    } else {
        $_SESSION['message'] = 'Erro ao atualizar o cliente';
        header('Location: index.php');
    }

    // Fecha o statement e encerra a conexão com o banco
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
