<?php
$alunos = [
	['nome' => 'Ana Beatriz', 'notas' => [7.5, 8.0, 6.5, 7.0]],
	['nome' => 'Bruno Henrique', 'notas' => [5.0, 5.5, 6.0, 4.5]],
	['nome' => 'Camila Souza', 'notas' => [9.0, 8.5, 9.5, 10.0]],
	['nome' => 'Diego Martins', 'notas' => [6.0, 5.0, 5.5, 6.5]],
	['nome' => 'Larissa Gomes', 'notas' => [7.0, 6.5, 8.0, 7.5]],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Notas do 8º Ano A</title>
	<style>
		body { font-family: Arial, sans-serif; margin: 2rem; }
		table { border-collapse: collapse; min-width: 650px; }
		th, td { border: 1px solid #555; padding: 10px 14px; text-align: center; }
		th { background: #ddd; }
		td:first-child { text-align: left; }
		.aprovado { background: #b9e6b9; color: #075c07; font-weight: bold; }
		.recuperacao { background: #f3b5b5; color: #8b0000; font-weight: bold; }
	</style>
</head>
<body>
	<h1>Notas do 8º Ano A</h1>
	<table>
		<thead>
			<tr>
				<th>Aluno</th>
				<th>1º Bimestre</th>
				<th>2º Bimestre</th>
				<th>3º Bimestre</th>
				<th>4º Bimestre</th>
				<th>Média</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($alunos as $aluno): ?>
				<?php $media = array_sum($aluno['notas']) / count($aluno['notas']); ?>
				<tr>
					<td><?= htmlspecialchars($aluno['nome'], ENT_QUOTES, 'UTF-8') ?></td>
					<?php foreach ($aluno['notas'] as $nota): ?>
						<td><?= number_format($nota, 1, ',', '.') ?></td>
					<?php endforeach; ?>
					<td class="<?= $media >= 6.0 ? 'aprovado' : 'recuperacao' ?>">
						<?= number_format($media, 1, ',', '.') ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>
