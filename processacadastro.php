<?php
$nomeCompleto = $_POST['nomeCompleto1'] ?? '';
$idade = $_POST['idade2'] ?? '';
$profissao = $_POST['profissao3'] ?? '';
$salarioPretendido = $_POST['salarioPretendido4'] ?? '';
$experienciaAnterior = $_POST['experienciaAnterior5'] ?? '';
?>

<html lang="pt-BR">
<head>
    <title>Confirmação de Cadastro</title>
</head>
<body>
	<h1>Dados cadastrados</h1>
	<p><strong>Nome completo:</strong> <?php echo h($nomeCompleto); ?></p>
	<p><strong>Idade:</strong> <?php echo h($idade); ?></p>
	<p><strong>Profissão:</strong> <?php echo h($profissao); ?></p>
	<p><strong>Salário pretendido:</strong> R$ <?php echo h($salarioPretendido); ?></p>
	<p><strong>Experiência anterior:</strong><br><?php echo nl2br(h($experienciaAnterior)); ?></p>

        <p class="w3-center w3-margin-top">
            <?php
                echo "Olá, " . htmlspecialchars($nomeCompleto) . ". Sua profissão foi registrada como " . htmlspecialchars($profissao) . ", e sua experiência anterior foi: " . htmlspecialchars($experienciaAnterior) . ". Obrigado por se cadastrar em nossa empresa!";
            ?>
        </p>

	<p><a href="cadastro.html">Voltar ao formulário</a></p>
    </div>
</body>
</html>