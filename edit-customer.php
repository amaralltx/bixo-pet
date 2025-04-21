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
    <link rel="stylesheet" href="css/edit.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <?php include 'components/header.php'; ?>
    
    <div class="edit-container">
        <form method="POST" action="actions.php" class="edit-form">
            <h2>Editar Cliente</h2>
            <div class="edit-form-inputs">
            <?php
                $sql = 'SELECT * FROM clientes WHERE id_cliente = ' . $_GET['id'];
                $result = mysqli_query($link, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $customer = mysqli_fetch_assoc($result); // Extrai os dados como um array associativo
                } else {
                    $customer = null; // Define como null caso não encontre resultados
                }
            ?>
                <div class="left-edit-form">
                    <div class="input-group">
                        <label for="nome">Nome do Cliente</label>
                        <input type="text" name="nome" id="nome" placeholder="<?=$customer['nome']?>"/>
                    </div>
                    <div class="input-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" placeholder="<?=$customer['telefone']?>"/>
                    </div>
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="<?=$customer['email']?>" />
                    </div>
                </div>
                <div class="right-edit-form">
                    <div class="input-group">
                        <label for="nome_pet">Nome do Pet</label>
                        <input type="text" name="nome_pet" id="nome_pet" placeholder="<?=$customer['nome_pet']?>"/>
                    </div>
                    <div class="input-group">
                        <label for="especie">Espécie</label>
                        <select id="especie" name="especie">
                            <option value="" <?= $customer['especie'] == '' ? 'selected' : '' ?>>--</option>
                            <option value="Cachorro" <?= $customer['especie'] == 'Cachorro' ? 'selected' : '' ?>>Cachorro</option>
                            <option value="Gato" <?= $customer['especie'] == 'Gato' ? 'selected' : '' ?>>Gato</option>
                            <option value="Pássaro" <?= $customer['especie'] == 'Pássaro' ? 'selected' : '' ?>>Pássaro</option>
                            <option value="Roedor" <?= $customer['especie'] == 'Roedor' ? 'selected' : '' ?>>Roedor</option>
                            <option value="Outros" <?= $customer['especie'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="raca">Raça</label>
                        <input type="text" name="raca" id="raca" placeholder="<?=$customer['raca']?>" />
                    </div>
                </div>
            </div>
            <div class="edit-form-btns">
                <a href="..">
                    <button class="edit-form-btn cancel" type="button" name="cancel">Cancelar</button>
                </a>
                <button class="edit-form-btn" type="submit" name="update_user" value="<?php echo $_GET['id']; ?>">Salvar</button>
            </div>

        </form>
    </div>

    <?php include 'components/footer.php'; ?>

</body>

</html>