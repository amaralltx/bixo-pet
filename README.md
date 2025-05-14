# Bixo Pet — CRUD (Disciplina de Computação em Nuvem, UTFPR)

Este é o trabalho acadêmico da disciplina de **Computação em Nuvem** da UTFPR. Trata-se de uma aplicação web CRUD para gerenciar clientes e seus pets, virtualizada em máquinas multipass.

---

## Objetivo

Demonstrar a virtualização de uma aplicação web CRUD, separando:
- **VM Web:** Apache2 + PHP (aplicação)
- **VM Database:** MySQL Server (banco de dados)
- **VM DNS:** BIND9 (resolução de `bixopet.com`)

---

## Tecnologias

- **Infraestrutura:** Multipass (Ubuntu 22.04 LTS)
- **Web server:** Apache2
- **Linguagem:** PHP 7.4+
- **Banco de dados:** MySQL 8.0
- **Frontend:** HTML5, CSS3, JavaScript
- **Controle de versão:** Git (GitHub)

---

## Estrutura de Arquivos

    /
    ├── index.php               # Página principal (lista de clientes)
    ├── view-customer.php       # Detalhes de um cliente
    ├── edit-customer.php       # Formulário de edição
    ├── log.php                 # Histórico de alterações
    ├── actions.php             # Tratamento de Create/Update/Delete
    ├── create_log.php          # Função de auditoria de logs
    ├── config/
    │   └── config.php          # Conexão com MySQL
    ├── components/
    │   ├── header.php          # Cabeçalho com logotipo
    │   ├── footer.php          # Rodapé
    │   ├── form.php            # Formulário de cadastro
    │   ├── table.php           # Tabela de exibição
    │   ├── filter.php          # Filtro por espécie
    │   ├── search.php          # Busca por nome
    │   └── message.php         # Mensagens de feedback
    ├── css/
    │   ├── style.css           # Estilos globais
    │   ├── table.css           # Estilos da tabela
    │   ├── edit.css            # Página de edição
    │   └── log.css             # Página de log
    ├── assets/
    │   ├── logo.png            # Logotipo da empresa fictícia
    │   └── svg/                # Ícones SVG
    └── README.md               # Este arquivo

---
