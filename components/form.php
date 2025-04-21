<!-- components/form.php -->
<form method="POST" action="../actions.php" id="crud_form" name="crud_form" class="crud-form">
    <div class="register-container" id="register-container" name="register-container" >
        <div class="register-section">
            <h2>Cliente</h2>
            <div class="half-register-section">
                <div class="input-register">
                    <label for="nome">Nome Cliente</label>
                    <input type="text" id="nome" name="nome" required />
                </div>
                <div class="input-register">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" required />
                </div>
            </div>
            <div class="input-register">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required />
            </div>
        </div>

        <div class="register-section">
            <h2>Pet</h2>
            <div class="input-register">
                <label for="nome_pet">Nome Pet</label>
                <input type="text" id="nome_pet" name="nome_pet" required />
            </div>
            <div class="half-register-section">
                <div class="input-register">
                    <label for="especie">Espécie</label>
                    <select id="especie" name="especie" required>
                        <option value="Cachorro">Cachorro</option>
                        <option value="Gato">Gato</option>
                        <option value="Pássaro">Pássaro</option>
                        <option value="Roedor">Roedor</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                <div class="input-register">
                    <label for="raca">Raça</label>
                    <input type="text" id="raca" name="raca" required />
                </div>
            </div>
        </div>
    </div>
</form>