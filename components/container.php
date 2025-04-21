<!-- components/container.php -->
<div class="crud-container">
    <div class="form-header">
        <div class="search-bar-container">
            <div class="search-bar">
                <form method="GET" action="">
                    <img src="assets/svg/search.svg" alt="Lupa de busca" />
                    <input type="text" id="search-input" name="busca" class="search-input" placeholder="Buscar por nome" />
                    <button type="submit" style="display: none;"></button>
                </form>
                <button type="button" class="btn-filter" onclick="showFilters()">
                    <img src="assets/svg/filter.svg" alt="Filtro" />
                </button>
            </div>
            <div class="filter-container">
                <h3>Filtro</h3>
                <div class="filter-options">
                    <div class="filter-left">
                        <div class="input-group">
                            <input type="radio" name="especie" id="">
                            <label for="cachorro">Cachorro</label>
                        </div>
                        <div class="input-group">
                            <input type="radio" name="especie" id="">
                            <label for="gato">Gato</label>
                        </div>
                        <div class="input-group">
                            <input type="radio" name="especie" id="">
                            <label for="passaro">Pássaro</label>
                        </div>
                    </div>
                    <div class="filter-right">
                        <div class="input-group">
                            <input type="radio" name="especie" id="">
                            <label for="roedor">Roedor</label>
                        </div>
                        <div class="input-group">
                            <input type="radio" name="especie" id="">
                            <label for="outro">Outro</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button name="cancel_user_btn" id="cancel_btn" type="button" class="btn-cancel">Cancelar</button>
            <button name="save_user_btn" id="save_btn" type="submit" form="crud_form" class="btn-save">Salvar</button>
            <button name="add_user_btn" id="add_btn" type="button" class="btn-add">Nova Entrada &nbsp;+</button>
        </div>
    </div>

    <?php include 'components/form.php'; ?>

    <?php include 'components/table.php'; ?>

    <script>
        let $especie = document.getElementsByName("especie");
        let selecionado = null;

        for (let i = 0; i < $especie.length; i++) {
            $especie[i].addEventListener("click", function () {
                // Se clicou no mesmo radio que já estava selecionado, desmarca
                if (selecionado === this) {
                    this.checked = false;
                    selecionado = null;

                    // Recarrega a lista completa
                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", `components/filter.php?especie=${encodeURIComponent("none")}`, true); //
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            const tableBody = document.querySelector(".crud-table tbody");
                            tableBody.innerHTML = xhr.responseText;
                        }
                    };
                    xhr.send();

                } else {
                    selecionado = this;

                    // Filtra a tabela com base na espécie selecionada
                    const especie = this.nextElementSibling.innerText;
                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", `components/filter.php?especie=${encodeURIComponent(especie)}`, true);
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            const tableBody = document.querySelector(".crud-table tbody");
                            tableBody.innerHTML = xhr.responseText;
                        }
                    };
                    xhr.send();
                }
            });
        }
    </script>
    <script>
        function showFilters() {
            $filter_container = document.querySelector(".filter-container")
            if ($filter_container.classList.contains("show")) {
                $filter_container.classList.remove("show")
            } else {
                $filter_container.classList.add("show")
            }
        }
    </script>
</div>