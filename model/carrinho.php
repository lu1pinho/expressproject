<?php
define('CAMINHO_IMAGENS', '../produtos/');
// Verifique se o carrinho já está criado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Inicializa o total
$total = 0;

// Verificar se o usuário está logado
if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
} else {
    die("Usuário não está logado. Por favor, faça o login para continuar.");
}

// Adiciona o produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar produto ao carrinho
    if (isset($_POST['produto_nome'])) {
        $produto = [
            'nome' => $_POST['produto_nome'],
            'url_img' => $_POST['produto_imagem'],
            'preco' => (float) $_POST['produto_preco'],
            'preco_com_desconto' => (isset($_POST['produto_preco_desconto']) && $_POST['produto_preco_desconto'] != '')
                ? (float) $_POST['produto_preco_desconto']
                : null,
            'quantidade' => (int) $_POST['quantidade']
        ];

        $_SESSION['carrinho'][] = $produto;

        // Salvar no banco de dados
        $stmt = $conn->prepare("INSERT INTO carrinho (id_user, produto_nome, url_img, preco, preco_com_desconto, quantidade) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issddi", $id_user, $produto['nome'], $produto['url_img'], $produto['preco'], $produto['preco_com_desconto'], $produto['quantidade']);
        $stmt->execute();
        $stmt->close();
    }

    // Remover item do carrinho
    if (isset($_POST['remover_item'])) {
        $index = (int)$_POST['remover_item']; // Índice do item a ser removido

        if (isset($_SESSION['carrinho'][$index])) {
            $produto_nome = $_SESSION['carrinho'][$index]['nome']; // Nome do produto a ser removido

            // Remove o item do carrinho na sessão
            unset($_SESSION['carrinho'][$index]);
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array

            // Remove o item do banco de dados
            $stmt = $conn->prepare("DELETE FROM carrinho WHERE id_user = ? AND produto_nome = ?");
            $stmt->bind_param("is", $id_user, $produto_nome);
            $stmt->execute();
            $stmt->close();
        } else {
            die("Produto não encontrado no carrinho.");
        }
    }

    // Alterar a quantidade do item no carrinho
    if (isset($_POST['alterar_quantidade'])) {
        foreach ($_POST['alterar_quantidade'] as $index => $operacao) {
            if (isset($_SESSION['carrinho'][$index])) {
                $produto_nome = $_SESSION['carrinho'][$index]['nome'];

                if ($operacao === 'plus') {
                    $_SESSION['carrinho'][$index]['quantidade']++;
                } elseif ($operacao === 'minus' && $_SESSION['carrinho'][$index]['quantidade'] > 1) {
                    $_SESSION['carrinho'][$index]['quantidade']--;
                }

                // Atualiza a quantidade no banco de dados
                $nova_quantidade = $_SESSION['carrinho'][$index]['quantidade'];
                $stmt = $conn->prepare("UPDATE carrinho SET quantidade = ? WHERE id_user = ? AND produto_nome = ?");
                $stmt->bind_param("iis", $nova_quantidade, $id_user, $produto_nome);
                $stmt->execute();
                $stmt->close();
            } else {
                die("Produto não encontrado no carrinho.");
            }
        }
    }
}

// Verifica se produtos foram selecionados e calcula o total
if (isset($_POST['produtos_selecionados'])) {
    foreach ($_POST['produtos_selecionados'] as $index) {
        if (isset($_SESSION['carrinho'][$index])) {
            $item = $_SESSION['carrinho'][$index];
            $preco_final = $item['preco_com_desconto'] ?? $item['preco']; // Usa o preço com desconto se existir
            $total += $preco_final * $item['quantidade'];
        }
    }
}

$conn->close();
?>