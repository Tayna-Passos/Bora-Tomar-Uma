<?php
$host = "db";
$dbname = "app_db";
$user = "root";
$pass = "root";

header('Content-Type: application/json');

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if (!$dados) {
        throw new Exception("Dados inválidos recebidos.");
    }

    $itens = json_encode($dados['carrinho'], JSON_UNESCAPED_UNICODE);

    $endereco = filter_var(
        $dados['endereco'] ?? '',
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $obs = filter_var(
        $dados['observacoes'] ?? '',
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $pagamento = filter_var(
        $dados['pagamento'] ?? '',
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    // --- TRATAMENTO DE VALORES MONETÁRIOS ---
    
    // Função auxiliar para limpar R$, pontos e trocar vírgula por ponto
   // Dentro do seu arquivo salvar_pedido.php, substitua a função limparMoeda:

function limparMoeda($valor) {
    if (empty($valor)) return 0;
    // Remove tudo que não for número ou vírgula/ponto
    $apenasNumeros = preg_replace('/[^0-9,.]/', '', $valor);
    // Se houver vírgula (formato brasileiro), ajusta para ponto decimal
    if (strpos($apenasNumeros, ',') !== false) {
        $apenasNumeros = str_replace('.', '', $apenasNumeros); // Tira ponto de milhar
        $apenasNumeros = str_replace(',', '.', $apenasNumeros); // Troca vírgula por ponto
    }
    return (float) $apenasNumeros;
}

    $gorjeta = limparMoeda($dados['gorjeta'] ?? '0');
    $total = limparMoeda($dados['total'] ?? '0');

    // NOVO: Captura o troco se enviado, caso contrário define como NULL
   $troco_para = null;
if (isset($dados['troco_para']) && !empty($dados['troco_para'])) {
    // A função limparMoeda garante que "R$ 50,00" vire 50.00
    $troco_para = limparMoeda($dados['troco_para']); 
}

    // --- SQL ATUALIZADO ---
    $sql = "INSERT INTO pedidos
            (itens, endereco, observacoes, gorjeta, pagamento, total, troco_para)
            VALUES
            (:itens, :endereco, :obs, :gorjeta, :pagamento, :total, :troco_para)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':itens' => $itens,
        ':endereco' => $endereco,
        ':obs' => $obs,
        ':gorjeta' => $gorjeta,
        ':pagamento' => $pagamento,
        ':total' => $total,
        ':troco_para' => $troco_para // Adicionado aqui
    ]);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Pedido realizado com sucesso!'
    ]);
    exit();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
