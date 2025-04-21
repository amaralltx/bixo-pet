# Bixo Espaço Pet - CRUD

This project is a simple CRUD (Create, Read, Update, Delete) application for managing customer and pet information.

## Features and Functionality

*   **Create:** Add new customer and pet records to the database.
*   **Read:** View customer and pet details in a table format.
*   **Update:** Edit existing customer and pet information.
*   **Delete:** Remove customer and pet records from the database.
*   **Search:** Search for customers by name.
*   **Filter:** Filter customers by pet species.
*   **Logging:** Logs all create, update, and delete operations with details of the changes and the IP address of the user performing the action.
*   **View Details:** Allows viewing the details of a customer and their pet on a separate page.

## Technology Stack

*   **Frontend:** HTML, CSS, JavaScript
*   **Backend:** PHP
*   **Database:** MySQL

## Prerequisites

Before running this application, ensure you have the following installed:

*   **PHP:** Version 7.0 or higher (required for running the PHP scripts).
*   **MySQL:** Version 5.6 or higher (required for the database).
*   **Web Server:** Apache or Nginx (required for serving the application).

## Installation Instructions

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/amaralltx/bixo-pet.git
    cd bixo-pet
    ```

2.  **Database Setup:**

    *   Create a MySQL database named `bixopet`.
    *   Import the database schema (you'll need to create the `clientes` and `log_alteracoes` tables, sample SQL structure below based on application usage).

    ```sql
    -- Example table structure (clientes)
    CREATE TABLE clientes (
        id_cliente INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        telefone VARCHAR(20),
        email VARCHAR(255),
        nome_pet VARCHAR(255),
        especie VARCHAR(255),
        raca VARCHAR(255),
        ultima_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    -- Example table structure (log_alteracoes)
    CREATE TABLE log_alteracoes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo_acao VARCHAR(10) NOT NULL,
        registro_id INT NOT NULL,
        dados_anteriores TEXT,
        dados_novos TEXT,
        ip_origem VARCHAR(50),
        data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

3.  **Configure the database connection:**

    *   Edit the `config/config.php` file to match your MySQL database credentials:

    ```php
    <?php
    define('DB_SERVER', 'your_db_server'); // e.g., 'localhost' or '127.0.0.1'
    define('DB_USERNAME', 'your_db_username');
    define('DB_PASSWORD', 'your_db_password');
    define('DB', 'bixopet');
    ```

4.  **Web Server Configuration:**

    *   Configure your web server (Apache or Nginx) to point to the project's root directory.
    *   Ensure that PHP is properly configured and enabled for your web server.
    *   Make sure the web server has the correct permissions to read and write to the project directory and especially the `php-error.log` file created by `actions.php`.

## Usage Guide

1.  **Access the application:**

    Open your web browser and navigate to the application's URL (e.g., `http://localhost/bixo-pet/`).

2.  **CRUD Operations:**

    *   **Add New Entry:** Click the "Nova Entrada +" button to open the registration form. Fill in the customer and pet details, and click "Salvar" to add the record.
    *   **View Details:** Click the "visibility" icon (eye symbol) in the table to view the details of a specific customer and their pet.
    *   **Edit:** Click the "edit" icon (pencil symbol) to open the edit page for a specific customer. Modify the desired fields and click "Salvar" to update the record.
    *   **Delete:** Click the "delete" icon (trash can symbol) to delete a customer record. You will be prompted to confirm the deletion.

3.  **Search:**

    *   Enter a customer name in the search bar and press Enter to filter the table.

4.  **Filter:**

    *   Click the "Filter" button to open the filter options. Select a pet species to filter the table by species.

5.  **View Logs:**
    *   Navigate to `log.php` to view a history of all changes made to the customer data.

## API Documentation

This project does not have a formal API. However, the `actions.php` file handles the create, update, and delete operations via HTTP POST requests.

*   **Create (actions.php):** Sends a POST request to `/actions.php` with the following parameters: `nome`, `telefone`, `email`, `nome_pet`, `especie`, `raca`, and `save_user_btn`.
*   **Update (actions.php):** Sends a POST request to `/actions.php` with the updated customer data along with `update_user` containing the customer ID.
*   **Delete (actions.php):** Sends a POST request to `/actions.php` with `delete_user` containing the ID of the customer to be deleted.

## Contributing Guidelines

Contributions are welcome! To contribute to this project, follow these steps:

1.  Fork the repository.
2.  Create a new branch for your feature or bug fix.
3.  Make your changes and commit them with descriptive messages.
4.  Push your changes to your fork.
5.  Submit a pull request to the main repository.

## License Information

This project does not have a specified license. All rights are reserved.

## Contact/Support Information

For questions or support, please contact:

[Your Name/Organization]
[Your Email]