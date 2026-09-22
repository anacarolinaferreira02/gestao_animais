<?php

require_once "../config/auth.php";
verificarLogin();

require_once "../config/conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $tipo = $_POST["tipo"];
    $titulo = trim($_POST["titulo"]);
    $descricao = trim($_POST["descricao"]);
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $localizacao = trim($_POST["localizacao"]);
    $data = $_POST["data_ocorrencia"];
    $hora = $_POST["hora_ocorrencia"];
    $telefone = trim($_POST["telefone_contato"]);

    if (
        empty($titulo) ||
        empty($descricao) ||
        empty($latitude) ||
        empty($longitude)
    ) {

        $erro = "Preencha todos os campos obrigatórios.";

    }


    if (
        !isset($_FILES["foto"]) ||
        $_FILES["foto"]["error"] !== UPLOAD_ERR_OK
    ) {

        $erro = "A foto do animal é obrigatória.";

    }


    if ($erro === "") {

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

            $nomeFoto =
                uniqid("ocorrencia_", true)
                . "."
                . $extensao;


            $pasta =
                "../uploads/ocorrencias/";


            if (!is_dir($pasta)) {

                mkdir(
                    $pasta,
                    0777,
                    true
                );

            }


            move_uploaded_file(
                $_FILES["foto"]["tmp_name"],
                $pasta . $nomeFoto
            );


            $sql = "

            INSERT INTO ocorrencias
            (
                usuario_id,
                tipo,
                titulo,
                descricao,
                foto,
                latitude,
                longitude,
                localizacao,
                data_ocorrencia,
                hora_ocorrencia,
                telefone_contato
            )

            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)

            ";


            $stmt =
                $pdo->prepare($sql);


            $stmt->execute([

                $_SESSION["usuario_id"],

                $tipo,

                $titulo,

                $descricao,

                $nomeFoto,

                $latitude,

                $longitude,

                $localizacao,

                $data,

                $hora,

                $telefone

            ]);


            header(
                "Location: ../mapa/index.php"
            );

            exit;
        }
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Registrar ocorrência</title>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

<link
rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
>

</head>

<body>
<script src="assets/js/script.js"></script>
<div class="form-page">

<div class="form-container">

<h1>🚨 Registrar ocorrência</h1>

<p class="form-description">

As ocorrências são analisadas pela equipe
antes de aparecerem no mapa público.

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


<label>Tipo de ocorrência</label>

<select name="tipo" required>

<option value="Perdido">
🔎 Animal perdido
</option>

<option value="Encontrado">
📍 Animal encontrado
</option>

</select>


<label>Título</label>

<input
type="text"
name="titulo"
placeholder="Ex.: Cachorro perdido no bairro..."
required
>


<label>Descrição detalhada</label>

<textarea
name="descricao"
placeholder="Informe características, raça, cor, coleira, porte etc."
required
></textarea>


<label>Foto do animal</label>

<input
type="file"
name="foto"
accept="image/*"
required
>


<label>Telefone para contato</label>

<input
type="text"
name="telefone_contato"
placeholder="(69) 99999-9999"
>


<label>Data</label>

<input
type="date"
name="data_ocorrencia"
required
>


<label>Horário aproximado</label>

<input
type="time"
name="hora_ocorrencia"
>


<label>Localização</label>

<input
type="text"
id="localizacao"
name="localizacao"
placeholder="Clique no mapa para marcar o local"
required
>


<input
type="hidden"
id="latitude"
name="latitude"
>

<input
type="hidden"
id="longitude"
name="longitude"
>


<div
id="occurrence-map">
</div>


<p class="map-help">

📍 Clique no mapa exatamente no local
onde o animal foi visto.

</p>


<button
class="btn-primary"
type="submit"
>

🚨 Enviar ocorrência

</button>


</form>

</div>

</div>


<script
src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script>

const map =
    L.map("occurrence-map")
    .setView(
        [-8.7619, -63.9039],
        13
    );


L.tileLayer(
    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
    {
        maxZoom: 19,
        attribution:
        "&copy; OpenStreetMap contributors"
    }
).addTo(map);


let marker = null;


map.on("click", function(e) {

    const latitude =
        e.latlng.lat;

    const longitude =
        e.latlng.lng;


    document.getElementById(
        "latitude"
    ).value = latitude;


    document.getElementById(
        "longitude"
    ).value = longitude;


    if (marker !== null) {

        map.removeLayer(marker);

    }


    marker =
        L.marker([
            latitude,
            longitude
        ])
        .addTo(map);


    marker
        .bindPopup(
            "📍 Local da ocorrência"
        )
        .openPopup();


    document.getElementById(
        "localizacao"
    ).value =
        latitude.toFixed(6)
        + ", "
        + longitude.toFixed(6);

});

</script>

</body>

</html>