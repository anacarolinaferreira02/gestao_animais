<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"]);
    $especie = trim($_POST["especie"]);
    $raca = trim($_POST["raca"]);
    $sexo = $_POST["sexo"];
    $idade = trim($_POST["idade"]);
    $cor = trim($_POST["cor"]);
    $status = $_POST["status"];
    $descricao = trim($_POST["descricao"]);

    $foto = null;


    if (
        isset($_FILES["foto"]) &&
        $_FILES["foto"]["error"] === UPLOAD_ERR_OK
    ) {

        $extensao =
            strtolower(
                pathinfo(
                    $_FILES["foto"]["name"],
                    PATHINFO_EXTENSION
                )
            );

        $permitidas = [
            "jpg",
            "jpeg",
            "png",
            "webp"
        ];

        if (!in_array(
            $extensao,
            $permitidas
        )) {

            $erro =
                "Formato de imagem inválido.";

        } else {

            $foto =
                uniqid("animal_", true)
                . "."
                . $extensao;

            $pasta =
                "../uploads/animais/";

            if (!is_dir($pasta)) {

                mkdir(
                    $pasta,
                    0777,
                    true
                );

            }

            move_uploaded_file(
                $_FILES["foto"]["tmp_name"],
                $pasta . $foto
            );
        }
    }


    if ($erro === "") {

        $stmt = $pdo->prepare("
            INSERT INTO animais
            (
                nome,
                especie,
                raca,
                sexo,
                idade,
                cor,
                status,
                descricao,
                foto
            )
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([

            $nome,
            $especie,
            $raca,
            $sexo,
            $idade,
            $cor,
            $status,
            $descricao,
            $foto

        ]);

        header(
            "Location: ../admin/animais.php"
        );

        exit;
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Cadastrar animal</title>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

</head>

<body>
<script src="assets/js/script.js"></script>
<div class="form-page">

<div class="form-container">

<h1>🐾 Cadastrar animal</h1>

<p>
Cadastre um animal no sistema.
</p>


<?php if ($erro): ?>

<div class="alert-error">

<?= htmlspecialchars($erro) ?>

</div>

<?php endif; ?>


<form
method="POST"
enctype="multipart/form-data"
>

<label>Nome</label>

<input
type="text"
name="nome"
required
>


<label>Espécie</label>

<select name="especie" required>

<option value="Cachorro">
Cachorro
</option>

<option value="Gato">
Gato
</option>

<option value="Outro">
Outro
</option>

</select>


<label>Raça</label>

<input
type="text"
name="raca"
>


<label>Sexo</label>

<select name="sexo">

<option value="Macho">
Macho
</option>

<option value="Fêmea">
Fêmea
</option>

</select>


<label>Idade</label>

<input
type="text"
name="idade"
placeholder="Ex.: 3 anos"
>


<label>Cor</label>

<input
type="text"
name="cor"
>


<label>Status</label>

<select name="status">

<option value="Cadastrado">
Cadastrado
</option>

<option value="Perdido">
Perdido
</option>

<option value="Encontrado">
Encontrado
</option>

<option value="Disponível para adoção">
Disponível para adoção
</option>

<option value="Adotado">
Adotado
</option>

</select>


<label>Descrição</label>

<textarea
name="descricao"
placeholder="Características do animal..."
></textarea>


<label>Foto</label>

<input
type="file"
name="foto"
accept="image/*"
>


<button
class="btn-primary"
type="submit"
>

Cadastrar animal

</button>

</form>

</div>

</div>

</body>

</html>