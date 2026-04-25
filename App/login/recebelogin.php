<?php
// Configurações do banco (ajuste conforme seu ambiente)
$host = "db"; 
$dbname = "app_db";
$user = "root";
$pass = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Pegando e limpando os dados
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = $_POST["senha"]; 

    // 2. SEGURANÇA: Criptografando a senha
    // Nunca guarde a senha "pura" no banco. O password_hash cria um código irreconhecível.
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // 3. Preparando a SQL
    $sql = "INSERT INTO usuarios (login, senha) VALUES (:login, :senha)";
    $stmt = $pdo->prepare($sql);
    
    // 4. Executando
    $stmt->execute([
        ':login' => $login,
        ':senha' => $senhaHash
    ]);

    // 5. REDIRECIONAMENTO: Em vez de uma página branca, volta para o login com sucesso
 header("Location: ../index.html?sucesso=1");
    exit();

} catch (PDOException $e) {
    // Em produção, não exiba o $e->getMessage() para o usuário final por segurança.
    die("Erro ao salvar: " . $e->getMessage());
}
?>