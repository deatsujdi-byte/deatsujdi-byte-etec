<?php
$produtos = [
    [
        'nome' => 'Camiseta',
        'quantidade' => 15,
        'preco' => 29.90
    ],
    [
        'nome' => 'Calça',
        'quantidade' => 8,
        'preco' => 79.99
    ],
    [
        'nome' => 'Tênis',
        'quantidade' => 5,
        'preco' => 149.90
    ],
    [
        'nome' => 'Boné',
        'quantidade' => 20,
        'preco' => 19.90
    ]
];

function exibirProdutos($produtos) {
    echo "Produtos em estoque:\n";

    foreach ($produtos as $produto) {
        echo "- {$produto['nome']} | Quantidade: {$produto['quantidade']} | Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "\n";
    }
}

function calcularValorTotal($produtos) {
    $total = 0;

    foreach ($produtos as $produto) {
        $total += $produto['quantidade'] * $produto['preco'];
    }

    return $total;
}

function listarEstoqueBaixo($produtos, $limite) {
    echo "\nProdutos com estoque baixo (abaixo de {$limite} unidades):\n";

    foreach ($produtos as $produto) {
        if ($produto['quantidade'] < $limite) {
            echo "- {$produto['nome']} | Estoque: {$produto['quantidade']}\n";
        }
    }
}

exibirProdutos($produtos);

$totalEstoque = calcularValorTotal($produtos);
echo "\nValor total do estoque: R$ " . number_format($totalEstoque, 2, ',', '.') . "\n";

listarEstoqueBaixo($produtos, 10);