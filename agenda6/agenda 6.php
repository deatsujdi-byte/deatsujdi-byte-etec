<?php
$host = 'localhost';
$database = 'pwii';
$user = 'root';
$password = '';
$search = trim($_GET['busca'] ?? '');
$students = [];
$error = '';

try {
	$pdo = new PDO(
		"mysql:host={$host};dbname={$database};charset=utf8mb4",
		$user,
		$password,
		[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
	);
	$sql = 'SELECT nome, nota1, nota2, nota3, nota4,
				   (nota1 + nota2 + nota3 + nota4) / 4 AS media
			FROM alunoconcluinte';
	if ($search !== '') {
		$sql .= ' WHERE nome LIKE :busca';
	}
	$sql .= ' ORDER BY media DESC, nome ASC';

	$statement = $pdo->prepare($sql);
	if ($search !== '') {
		$statement->bindValue(':busca', "%{$search}%", PDO::PARAM_STR);
	}
	$statement->execute();
	$students = $statement->fetchAll();
} catch (PDOException $exception) {
	$error = 'Não foi possível conectar ao banco de dados. Verifique as configurações.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Notas dos alunos concluintes</title>
	<style>
		:root { --primary:#2457a6; --dark:#17345f; --light:#f3f7fc; }
		* { box-sizing:border-box; }
		body { margin:0; font-family:Arial,sans-serif; color:#243447; background:var(--light); }
		.container { width:min(1050px,92%); margin:40px auto; }
		header { color:white; background:linear-gradient(135deg,var(--dark),var(--primary)); padding:30px; border-radius:16px 16px 0 0; }
		h1 { margin:0 0 8px; font-size:clamp(1.5rem,4vw,2.2rem); }
		header p { margin:0; opacity:.9; }
		.panel { background:white; padding:22px; box-shadow:0 8px 24px #17345f18; }
		form { display:flex; gap:10px; margin-bottom:20px; }
		input { flex:1; padding:12px 14px; border:1px solid #ccd6e5; border-radius:8px; font-size:1rem; }
		button, .clear { border:0; border-radius:8px; padding:12px 18px; color:white; background:var(--primary); cursor:pointer; text-decoration:none; }
		.clear { background:#64748b; }
		.table-wrap { overflow-x:auto; }
		table { width:100%; border-collapse:collapse; min-width:650px; }
		th,td { padding:14px 12px; text-align:center; border-bottom:1px solid #e6ebf2; }
		th { color:white; background:var(--primary); }
		th:first-child, td:first-child, th:nth-child(2), td:nth-child(2) { text-align:left; }
		tr:hover { background:#f5f9ff; }
		.rank { font-weight:bold; color:var(--primary); }
		.average { font-weight:bold; color:var(--dark); }
		.message { padding:14px; border-radius:8px; background:#fff4d6; color:#765900; }
		footer { padding:18px; text-align:center; color:#64748b; font-size:.9rem; }
		@media (max-width:600px) { form { flex-wrap:wrap; } input { flex-basis:100%; } }
	</style>
</head>
<body>
<main class="container">
	<header>
		<h1>Notas dos alunos concluintes</h1>
		<p>Ranking organizado pela média dos quatro módulos</p>
	</header>
	<section class="panel">
		<!-- Formulário de busca por nome; o filtro é processado no servidor. -->
		<form method="get" role="search">
			<input type="search" name="busca" value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>" placeholder="Pesquisar aluno..." aria-label="Pesquisar aluno">
			<button type="submit">Buscar</button>
			<?php if ($search !== ''): ?><a class="clear" href="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') ?>">Limpar</a><?php endif; ?>
		</form>

		<?php if ($error): ?>
			<p class="message"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
		<?php elseif (!$students): ?>
			<p class="message">Nenhum aluno encontrado.</p>
		<?php else: ?>
			<div class="table-wrap">
				<table>
					<thead><tr><th>Ranking</th><th>Aluno</th><th>Módulo 1</th><th>Módulo 2</th><th>Módulo 3</th><th>Módulo 4</th><th>Média</th></tr></thead>
					<tbody>
					<?php foreach ($students as $position => $student): ?>
						<tr>
							<td class="rank">#<?= $position + 1 ?></td>
							<td><?= htmlspecialchars($student['nome'], ENT_QUOTES, 'UTF-8') ?></td>
							<td><?= number_format((float)$student['nota1'], 1, ',', '.') ?></td>
							<td><?= number_format((float)$student['nota2'], 1, ',', '.') ?></td>
							<td><?= number_format((float)$student['nota3'], 1, ',', '.') ?></td>
							<td><?= number_format((float)$student['nota4'], 1, ',', '.') ?></td>
							<td class="average"><?= number_format((float)$student['media'], 2, ',', '.') ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</section>
	<footer>Consulta de alunos concluintes • <?= date('Y') ?></footer>
</main>
</body>
</html>
