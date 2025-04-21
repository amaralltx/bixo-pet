<?php
    require '../config/config.php';

    $specie = isset($_GET['especie']) ? $_GET['especie'] : ''; // sem escape aqui, o bind já cuida disso

    if ($specie == 'none') {
        // SQL sem filtro
        $sql = "SELECT * FROM clientes";
        $stmt = mysqli_prepare($link, $sql);
        
    } else {
        // Prepara o SQL com filtro
        $sql = "SELECT * FROM clientes WHERE especie = ?";
        
        // Prepara o statement
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $specie);
    }
    
    if (!mysqli_stmt_execute($stmt)) {
        die("Erro ao executar a query: " . mysqli_stmt_error($stmt));
    }
    // Recupera o resultado
    $customers = mysqli_stmt_get_result($stmt);
    // Verifica se retornou algum cliente
    if (mysqli_num_rows($customers) > 0) {
        // Percorre cada cliente retornado como array
        while ($customer = mysqli_fetch_assoc($customers)) {
            // Cria uma nova linha na tabela com os dados do cliente
            echo '<tr class="main-row">';
        
            // Link de visualização do cliente (ícone de olho)
            echo '<td><a href="../view-customer.php?id=' . $customer['id_cliente'] . '" class="material-symbols-outlined">visibility</a></td>';
        
            // Colunas com os dados do cliente
            echo '<td>' . $customer['nome'] . '</td>';
            echo '<td>' . $customer['email'] . '</td>';
            echo '<td>' . $customer['nome_pet'] . '</td>';
            echo '<td>' . $customer['especie'] . '</td>';
        
            // Coluna com botões de edição e exclusão
            echo '<td>
                    <button name="edit_user" class="material-symbols-outlined"
                        onclick="window.location.href=\'edit-customer.php?id=' . $customer['id_cliente'] . '\'">
                        edit
                    </button>
                    <form action="../actions.php" method="POST">
                        <button onclick="return confirm(\'Tem certeza que deseja excluir o cliente?\')" type="submit" name="delete_user"
                            value="' . $customer['id_cliente'] . '" class="material-symbols-outlined">
                            delete
                        </button>
                    </form>
                </td>';
            echo '</tr>';
        }
    } else {
        // Se nenhum cliente foi encontrado, exibe uma linha informando isso
        echo '<tr><td colspan="6"><h5>Nenhum usuário encontrado</h5></td></tr>';
    }

    // Fecha a conexão
    mysqli_close($link);
?>
