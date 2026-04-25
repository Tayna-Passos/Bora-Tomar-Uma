<?php
session_start(); // Inicia a sessão para manter o usuário logado
$host = "db"; 
$dbname = "app_db";
$user = "root";
$pass = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST["senha"];

    // 1. Busca o usuário pelo e-mail
    $sql = "SELECT * FROM cadastro WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Verifica se o usuário existe e se a senha "bate" com o hash
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // LOGIN COM SUCESSO
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        header("Location: dashboard.php"); // Manda para a área restrita
        exit();
    } else {
        // FALHA NO LOGIN
        header("Location: login.html?erro=1");
        exit();
    }

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}