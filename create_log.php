<?php 
require 'config/config.php';

function create_log($tipo_acao, $id_tabela, $dados_anteriores, $dados_novos) {
    global $link;

    // Guarda o ip de quem fez a alteração
    $ip_origem = getClientIP();

    $sql = "INSERT INTO log_alteracoes (tipo_acao, registro_id, dados_anteriores, dados_novos, ip_origem) 
            VALUES (?, ?, ?, ?, ?)";   

    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        error_log("Erro na preparação do log: " . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "sssss", $tipo_acao, $id_tabela, $dados_anteriores, $dados_novos, $ip_origem);

    if (!mysqli_stmt_execute($stmt)) {
        error_log("Erro ao executar o log: " . mysqli_stmt_error($stmt));
    }
    
}

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Pode conter uma lista de IPs separados por vírgula
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]);
    } elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    } else {
        return "batata";
    }
}

