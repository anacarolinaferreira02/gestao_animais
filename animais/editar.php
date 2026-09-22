<?php

require_once "../config/auth.php";
verificarAdmin();

require_once "../config/conexao.php";

$id = intval($_GET["id"] ?? 0);

$stmt = $pdo->prepare("
    SELECT *
    FROM animais
    WHERE id = ?
");

$stmt->execute([$id]);

$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {

    die("Animal não encontrado.");

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"]);
    $especie = trim($_POST["especie"]);
    $raca = trim($_POST["raca"]);
    $sexo = $_POST["sexo"];
    $idade = trim($_POST["idade"]);
    $cor = trim($_POST["cor"]);
    $status = $_POST["status"];
    $descricao = trim($_POST["descricao"]);


    $foto = $animal["foto"];


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

        $foto =
            uniqid("animal_", true)
            . "."
            . $extensao;

        move_uploaded_file(
            $_FILES["foto"]["tmp_name"],
            "../uploads/animais/" . $foto
        );
    }


    $stmt = $pdo->prepare("
        UPDATE animais

        SET
            nome = ?,
            especie = ?,
            raca = ?,
            sexo = ?,
            idade = ?,
            cor = ?,
            status = ?,
            descricao = ?,
            foto = ?

        WHERE id = ?
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
        $foto,
        $id

    ]);


    header(
        "Location: ../admin/animais.php"
    );

    exit;
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Editar animal</title>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

</head>

<body>
<script src="assets/js/script.js"></script>
<div class="form-page">

<div class="form-container">

<h1>✏️ Editar animal</h1>

<form
method="POST"
enctype="multipart/form-data"
>

<label>Nome</label>

<input
type="text"
name="nome"
value="<?= htmlspecialchars($animal["nome"]) ?>"
required
>


<label>Espécie</label>

<input
type="text"
name="especie"
value="<?= htmlspecialchars($animal["especie"]) ?>"
required
>


<label>Raça</label>

<input
type="text"
name="raca"
value="<?= htmlspecialchars($animal["raca"]) ?>"
>


<label>Sexo</label>

<select name="sexo">

<option
value="Macho"
<?= $animal["sexo"] === "Macho" ? "selected" : "" ?>
>
Macho
</option>

<option
value="Fêmea"
<?= $animal["sexo"] === "Fêmea" ? "selected" : "" ?>
>
Fêmea
</option>

</select>


<label>Idade</label>

<input
type="text"
name="idade"
value="<?= htmlspecialchars($animal["idade"]) ?>"
>


<label>Cor</label>

<input
type="text"
name="cor"
value="<?= htmlspecialchars($animal["cor"]) ?>"
>


<label>Status</label>

<select name="status">

<?php

$statusOptions = [
    "Cadastrado",
    "Perdido",
    "Encontrado",
    "Disponível para adoção",
    "Adotado"
];

foreach ($statusOptions as $status):

?>

<option
value="<?= $status ?>"
<?= $animal["status"] === $status ? "selected" : "" ?>
>

<?= $status ?>

</option>

<?php endforeach; ?>

</select>


<label>Descrição</label>

<textarea
name="descricao"
><?= htmlspecialchars($animal["descricao"]) ?></textarea>


<label>Nova foto</label>

<input
type="file"
name="foto"
accept="image/*"
>


<button
class="btn-primary"
type="submit"
>

Salvar alterações

</button>

</form>

</div>

</div>

</body>

</html>