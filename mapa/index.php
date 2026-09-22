<?php

require_once "../config/conexao.php";

$sql = "
SELECT
    o.id,
    o.tipo,
    o.titulo,
    o.descricao,
    o.foto,
    o.latitude,
    o.longitude,
    o.localizacao,
    o.data_ocorrencia

FROM ocorrencias o

WHERE o.status_verificacao = 'Aprovada'

ORDER BY o.criado_em DESC
";

$ocorrencias = $pdo
    ->query($sql)
    ->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Mapa de Ocorrências</title>

<link
rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<link
rel="stylesheet"
href="../assets/css/style.css"
>

</head>

<body>
<script src="assets/js/script.js"></script>
<header class="public-header">

<div class="public-logo">
🐾 Minha Patinha
</div>

<nav>

<a href="../index.php">
Início
</a>

<a href="../dashboard.php">
Dashboard
</a>

<a href="../ocorrencias/cadastrar.php">
Registrar ocorrência
</a>

</nav>

</header>


<main class="map-page">

<div class="map-header">

<div>

<h1>🗺️ Mapa de animais</h1>

<p>
Veja ocorrências verificadas de animais perdidos
e encontrados.
</p>

</div>

<div class="map-legend">

<span>
🔴 Perdido
</span>

<span>
🔵 Encontrado
</span>

</div>

</div>


<div id="map"></div>

</main>


<script
src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script>

const map = L.map("map").setView(
    [-8.7619, -63.9039],
    12
);


L.tileLayer(
    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
    {
        maxZoom: 19,
        attribution:
        '&copy; OpenStreetMap contributors'
    }
).addTo(map);


const ocorrencias =
<?= json_encode($ocorrencias) ?>;


ocorrencias.forEach(function(ocorrencia) {

    const latitude =
        parseFloat(ocorrencia.latitude);

    const longitude =
        parseFloat(ocorrencia.longitude);


    if (
        isNaN(latitude) ||
        isNaN(longitude)
    ) {
        return;
    }


    const cor =
        ocorrencia.tipo === "Perdido"
        ? "red"
        : "blue";


    const marker =
        L.circleMarker(
            [latitude, longitude],
            {
                radius: 10,
                color: cor,
                fillColor: cor,
                fillOpacity: 0.8
            }
        );


    const foto =
        "../uploads/ocorrencias/"
        + ocorrencia.foto;


    const popup = `

        <div class="map-popup">

            <img
                src="${foto}"
                alt="Animal"
            >

            <h3>
                ${ocorrencia.titulo}
            </h3>

            <strong>
                ${ocorrencia.tipo}
            </strong>

            <p>
                ${ocorrencia.descricao}
            </p>

            <p>
                📍 ${ocorrencia.localizacao}
            </p>

            <p>
                📅 ${ocorrencia.data_ocorrencia}
            </p>

            <span class="verified">
                ✅ Ocorrência verificada
            </span>

        </div>

    `;


    marker
        .bindPopup(popup)
        .addTo(map);

});

</script>

</body>

</html>