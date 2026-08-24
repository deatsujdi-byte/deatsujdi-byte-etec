<?php
$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome = trim($_POST['txtNome'] ?? '');
	$valorCompra = filter_input(INPUT_POST, 'txtValorCompra', FILTER_VALIDATE_FLOAT);
	$formaPagamento = $_POST['cmbPag'] ?? '';

	$percentuais = [
		'deposito' => 0.10,
		'boleto' => 0.08,
		'cartaoCredito' => 0.00,
	];
	$nomesPagamento = [
		'deposito' => 'depósito',
		'boleto' => 'boleto',
		'cartaoCredito' => 'cartão de crédito',
	];

	if ($nome === '' || $valorCompra === false || $valorCompra < 0 || !isset($percentuais[$formaPagamento])) {
		$mensagem = 'Preencha todos os campos corretamente e selecione uma forma de pagamento válida.';
		$tipoMensagem = 'erro';
	} else {
		$desconto = $valorCompra * $percentuais[$formaPagamento];
		$valorFinal = $valorCompra - $desconto;
		$pagamento = $nomesPagamento[$formaPagamento];
		$mensagem = sprintf(
			'Olá, %s! Sua compra de R$ %.2f foi realizada com %s. Desconto: R$ %.2f. Valor final: R$ %.2f.',
			htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
			$valorCompra,
			$pagamento,
			$desconto,
			$valorFinal
		);
		$tipoMensagem = 'sucesso';
	}
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Madeira e Cia</title>
	<style>
		:root { --marrom: #6f4328; --creme: #fff8ef; --verde: #287a50; }
		* { box-sizing: border-box; }
		body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; background: linear-gradient(135deg, #ead4bd, #fff8ef); font-family: Arial, sans-serif; color: #35251d; }
		.card { width: min(100%, 480px); padding: 32px; background: #fff; border-radius: 18px; box-shadow: 0 12px 35px #6f432833; }
		h1 { margin: 0 0 8px; color: var(--marrom); } .intro { margin-top: 0; color: #765d4e; }
		label { display: block; margin: 18px 0 7px; font-weight: bold; }
		input, select, button { width: 100%; padding: 12px; border: 1px solid #d8c2af; border-radius: 8px; font-size: 1rem; }
		input:focus, select:focus { outline: 2px solid #d59a68; }
		button { margin-top: 24px; border: 0; background: var(--marrom); color: #fff; font-weight: bold; cursor: pointer; }
		button:hover { background: #512d1b; } .mensagem { margin-top: 22px; padding: 14px; border-radius: 8px; line-height: 1.5; }
		.sucesso { background: #e2f5e9; color: var(--verde); } .erro { background: #fde8e8; color: #a52a2a; }
	</style>
</head>
<body>
	<main class="card">
		<h1>Madeira e Cia</h1>
		<p class="intro">Promoção de aniversário: escolha a forma de pagamento.</p>
		<form method="post" action="">
			<label for="txtNome">Nome do cliente</label>
			<input type="text" id="txtNome" name="txtNome" required value="<?= htmlspecialchars($_POST['txtNome'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

			<label for="txtValorCompra">Valor da compra (R$)</label>
			<input type="number" id="txtValorCompra" name="txtValorCompra" min="0" step="0.01" required value="<?= htmlspecialchars($_POST['txtValorCompra'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

			<label for="cmbPag">Forma de pagamento</label>
			<select id="cmbPag" name="cmbPag" required>
				<option value="">Selecione...</option>
				<option value="deposito" <?= (($_POST['cmbPag'] ?? '') === 'deposito') ? 'selected' : '' ?>>Depósito (10% de desconto)</option>
				<option value="boleto" <?= (($_POST['cmbPag'] ?? '') === 'boleto') ? 'selected' : '' ?>>Boleto (8% de desconto)</option>
				<option value="cartaoCredito" <?= (($_POST['cmbPag'] ?? '') === 'cartaoCredito') ? 'selected' : '' ?>>Cartão de crédito (sem desconto)</option>
			</select>
			<button type="submit">Calcular promoção</button>
		</form>
		<?php if ($mensagem !== ''): ?>
			<div class="mensagem <?= $tipoMensagem ?>" role="alert"><?= $mensagem ?></div>
		<?php endif; ?>
	</main>
</body>
</html>