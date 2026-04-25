<?php
// Configurações do banco (ajuste conforme seu ambiente)
$host = "db"; 
$dbname = "app_db";
$user = "root";
$pass = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Pegando e limpando os dados (Sanitização)
    // Usamos filtros para evitar que caracteres maliciosos quebrem o HTML ou o banco
    $nome     = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $assunto  = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);

    // 2. Preparando a SQL
    // Assumindo que sua tabela se chame 'contatos' ou 'mensagens'
    $sql = "INSERT INTO mensagens (nome, email, assunto, mensagem) 
            VALUES (:nome, :email, :assunto, :mensagem)";
    
    $stmt = $pdo->prepare($sql);
    
    // 3. Executando e vinculando os dados (Prevenção contra SQL Injection)
    $stmt->execute([
        ':nome'     => $nome,
        ':email'    => $email,
        ':assunto'  => $assunto,
        ':mensagem' => $mensagem
    ]);

    // 4. REDIRECIONAMENTO: Volta para a página de contato com uma flag de sucesso
    header("Location: ../index.html?sucesso=1");
    exit();

} catch (PDOException $e) {
    // Em desenvolvimento você pode usar $e->getMessage(), 
    // mas em produção, salve em um log e mostre uma mensagem amigável.
    die("Erro ao salvar mensagem: " . $e->getMessage());
}
?>