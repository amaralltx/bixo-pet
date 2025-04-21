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
    <link rel="stylesheet" href="css/log.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  </head>
  <body>
    <?php include 'components/header.php'; ?>
    <div class="log-container">
        <h2>Log de Alterações</h2>
        <?php
            $sql = "SELECT 
                        id,
                        tipo_acao,
                        registro_id,
                        dados_anteriores,
                        dados_novos,
                        ip_origem,
                        DATE_FORMAT(data, '%d-%m-%Y %H:%i:%s') AS data
                    FROM 
                        log_alteracoes;";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Decodifica os campos JSON
                    $dados_anteriores = json_decode($row['dados_anteriores'], true);
                    $dados_novos = json_decode($row['dados_novos'], true);

        ?>          
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                <?php echo htmlspecialchars($row['tipo_acao']) . " - ID: " . htmlspecialchars($row['registro_id']) . " - " . htmlspecialchars($row['data'] ?? 'Data não encontrada'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                    <?php
                        if($row['tipo_acao'] != 'INSERT') {
                    ?>        
                            <div class="card-before">
                                <h4>Dados Anteriores</h4>
                                <table class="log-table">
                                    <thead class="table-head">
                                        <tr>
                                            <th>Nome Cliente</th>
                                            <th>Telefone</th>
                                            <th>Email</th>
                                            <th>Nome Pet</th>
                                            <th>Espécie</th>
                                            <th>Raça</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <tr>
                                            <td><?php echo htmlspecialchars($dados_anteriores['nome'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_anteriores['telefone'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_anteriores['email'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_anteriores['nome_pet'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_anteriores['especie'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_anteriores['raca'] ?? '-'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <?php
                        }
                        if($row['tipo_acao'] != 'DELETE') {
                    ?>            
                            <div class="card-after">
                                <h4>Dados Novos</h4>
                                <table class="log-table">
                                    <thead class="table-head">
                                        <tr>
                                            <th>Nome Cliente</th>
                                            <th>Telefone</th>
                                            <th>Email</th>
                                            <th>Nome Pet</th>
                                            <th>Espécie</th>
                                            <th>Raça</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <tr>
                                            <td><?php echo htmlspecialchars($dados_novos['nome'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_novos['telefone'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_novos['email'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_novos['nome_pet'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_novos['especie'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($dados_novos['raca'] ?? '-'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <?php
                        }
                    ?>            
                            <div class="card-footer">
                                <p>IP de origem: <?php echo htmlspecialchars($row['ip_origem'] ?? 'IP não encontrado'); ?></p>
                            </div>
                        </div>
                    </div>    
        <?php
                }
            } else {
                echo "<p>Nenhum registro encontrado.</p>";
            }
        ?>
    </div>
    <?php include 'components/footer.php'; ?>
</body>

</html>