<?php
// Configurações do banco (Verifique se host=db está correto para seu ambiente)
$host = "db"; 
$dbname = "app_db";
$user = "root";
$pass = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pegando os dados do seu formulário
    $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST["senha"]; 

    // Verifica se o e-mail já existe
    $check = $pdo->prepare("SELECT id FROM cadastro WHERE email = :email");
    $check->execute([':email' => $email]);
    
    if ($check->rowCount() > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!'); window.history.back();</script>";
        exit();
    }

    // Criptografia da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserção no banco
    $sql = "INSERT INTO cadastro (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':nome'  => $nome,
        ':email' => $email,
        ':senha' => $senhaHash
    ]);

    // Redireciona de volta para o login (ou index)
    header("Location: login.php?sucesso=1");
    exit();

} catch (PDOException $e) {
    die("Erro ao salvar: " . $e->getMessage());
}
?>