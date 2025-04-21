<!-- components/table.php -->
<div class="div-table">
    <table class="crud-table" rules="groups">
        <thead class="table-head">
            <tr>
                <th></th>
                <th>Nome Cliente</th>
                <th>E-mail</th>
                <th>Nome Pet</th>
                <th>Espécie</th>
                <th>Editar | Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $busca = isset($_GET['busca']) ? mysqli_real_escape_string($link, $_GET['busca']) : '';

            //
            $sql = "SELECT * FROM clientes";
            if (!empty($busca)) {
                $sql .= " WHERE nome LIKE '%$busca%'";
            }

            $customers = mysqli_query($link, $sql);

            if (mysqli_num_rows($customers) > 0) {
                foreach ($customers as $customer) {
            ?>
                    <tr class="main-row">
                        <td>
                            <a href="../view-customer.php?id=<?= $customer['id_cliente']; ?>" class="material-symbols-outlined">visibility</a>
                        </td>
                        <td><?= $customer['nome'] ?></td>
                        <td><?= $customer['email'] ?></td>
                        <td><?= $customer['nome_pet'] ?></td>
                        <td><?= $customer['especie'] ?></td>
                        <td>
                            <button name="edit_user" class="material-symbols-outlined"
                                onclick="window.location.href='edit-customer.php?id=<?= $customer['id_cliente']; ?>'">
                                edit
                            </button>
                            <form action="../actions.php" method="POST">
                                <button onclick="return confirm('Tem certeza que deseja excluir o cliente?')" type="submit" name="delete_user"
                                    value="<?= $customer['id_cliente'] ?>" class="material-symbols-outlined">
                                    delete
                                </button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo ('<tr><td colspan="5"><h5>Nenhum usuário encontrado</h5></td></tr>');
            }
            ?>
        </tbody>
    </table>
</div>