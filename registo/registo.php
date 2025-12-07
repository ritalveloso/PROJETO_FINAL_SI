<?php
// Conexão ao PostgreSQL
try {
    $conn = new PDO("pgsql:host=localhost;dbname=eat_easy", "postgres", "postgres");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Receber dados do formulário HTML
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Encriptar a password antes de guardar
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Inserir na tabela utilizadores
    $sql = "INSERT INTO utilizadores (nome, email, password) VALUES (:nome, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hash);

    $stmt->execute();

    echo "Registo efetuado com sucesso!";
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

