<?php
include 'conexao.php';
include 'funcoes_imagem.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Defina a geração que quer importar (1 a 9 ou 0 para todas)
$geracao = 0; // 0 = todas, 1 = Gen 1, 2 = Gen 2...

$geracoes = [
    1 => ['inicio' => 1, 'fim' => 151, 'titulo' => 'Geração 1'],
    2 => ['inicio' => 152, 'fim' => 251, 'titulo' => 'Geração 2'],
    3 => ['inicio' => 252, 'fim' => 386, 'titulo' => 'Geração 3'],
    4 => ['inicio' => 387, 'fim' => 493, 'titulo' => 'Geração 4'],
    5 => ['inicio' => 494, 'fim' => 649, 'titulo' => 'Geração 5'],
    6 => ['inicio' => 650, 'fim' => 721, 'titulo' => 'Geração 6'],
    7 => ['inicio' => 722, 'fim' => 809, 'titulo' => 'Geração 7'],
    8 => ['inicio' => 810, 'fim' => 905, 'titulo' => 'Geração 8'],
    9 => ['inicio' => 906, 'fim' => 1025, 'titulo' => 'Geração 9']
];


if ($geracao && isset($geracoes[$geracao])) {
    $inicio = $geracoes[$geracao]['inicio'];
    $fim    = $geracoes[$geracao]['fim'];
    echo "<h2>Importando Pokémon - Geração $geracao</h2>";
} else {
    $inicio = 1;
    $fim    = 1025;
    echo "<h2>Importando Pokémon - Todas as Gerações</h2>";
}

for ($i = $inicio; $i <= $fim; $i++) {
    $numero = str_pad($i, 4, "0", STR_PAD_LEFT);

    // Verifica se já existe
    $check = $conn->query("SELECT id_national FROM tb_nationaldex WHERE numero_national='$numero'");
    if ($check->num_rows > 0) continue;

    $url = "https://pokeapi.co/api/v2/pokemon/$i/";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $resp = curl_exec($ch);
    curl_close($ch);

    if (!$resp) continue;

    $data = json_decode($resp, true);
    if (!$data) continue;

    $nome = $conn->real_escape_string($data['name']);
    $tipo1 = $conn->real_escape_string($data['types'][0]['type']['name']);
    $tipo2 = isset($data['types'][1]) ? $conn->real_escape_string($data['types'][1]['type']['name']) : NULL;
    $img   = getPokemonImageN($data['sprites']['front_default'] ?? null);

    $sql = "INSERT INTO tb_nationaldex (numero_national, nome_national, tipo1, tipo2, imagem)
            VALUES ('$numero', '$nome', '$tipo1', '$tipo2', '$img')";

    if ($conn->query($sql)) {
        echo "<p>✅ Importado #$numero - $nome</p>";
    } else {
        echo "<p>❌ Erro #$numero - $nome: " . $conn->error . "</p>";
    }

    flush();
    usleep(300000); // leve delay
}

$conn->close();
echo "<h3>Importação concluída!</h3>";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Dex</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/national_dex.css">
    <link rel="stylesheet" href="css/menu.geracoes.css">
    <link rel="stylesheet" href="css/busca_national.css">
    <link rel="icon" href="img/pokedex.png" type="image/png">
</head>

<body>
    <?php include 'cabecalho.php'; ?>

    <div class="menu-hamburguer" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <nav id="menu-lateral">
        <ul>
            <?php foreach ($geracoes as $ger => $info): ?>
                <li><a href="#gen<?php echo $ger; ?>"><?php echo $info['titulo']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="header-container">
        <h1 id="titulo">Pokémon por Número na National Dex</h1>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar Pokémon...">
            <button id="searchButton">🔍</button>
            <ul id="suggestions" class="suggestions-list"></ul>
        </div>
    </div>

    <?php
    $pokemons = [];
    foreach ($geracoes as $ger => $info) {
        $inicio = str_pad($info['inicio'], 4, "0", STR_PAD_LEFT);
        $fim    = str_pad($info['fim'], 4, "0", STR_PAD_LEFT);

        echo "<h2 class='subtitulo' id='gen$ger'>{$info['titulo']}</h2>";
        echo "<table>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Tipo 1</th>
            <th>Tipo 2</th>
            <th>Imagem</th>
        </tr>";

        $result = $conn->query("SELECT numero_national, nome_national, tipo1, tipo2, imagem 
                            FROM tb_nationaldex 
                            WHERE numero_national BETWEEN '$inicio' AND '$fim' 
                            ORDER BY numero_national");

        while ($row = $result->fetch_assoc()) {
            $numero = $row['numero_national'] ?? '';
            $nome = $row['nome_national'] ?? '';
            $tipo1 = $row['tipo1'] ?? '-';
            $tipo2 = $row['tipo2'] ?? '-';
            $imagem = $row['imagem'] ?: 'img/fallback.png'; // fallback se não existir

            $urlPokemon = "pokemon.php?nome=" . urlencode($nome);
            $tipo1Url = "tipo.php?tipo=" . urlencode($tipo1);
            $tipo2Url = "tipo.php?tipo=" . urlencode($tipo2);

            echo "<tr>
            <td id='numero'>{$numero}</td>
            <td class='nome'><a class='link' href='$urlPokemon'>{$nome}</a></td>
            <td class='tipo1 " . strtolower($tipo1) . "'><a class='link' href='$tipo1Url'>{$tipo1}</a></td>
            <td class='tipo2 " . strtolower($tipo2) . "'>" . ($tipo2 != '-' ? "<a class='link' href='$tipo2Url'>{$tipo2}</a>" : '-') . "</td>
            <td><a href='$urlPokemon'><img src='{$imagem}' alt='{$nome}'></a></td>
        </tr>";

            $pokemons[] = [
                'name' => $nome,
                'tipo1' => $tipo1,
                'tipo2' => $tipo2,
                'sprite' => $imagem
            ];
        }
        echo "</table>";
    }
    $conn->close();
    ?>

    <script src="js/menu_hamburguer.js"></script>
    <script src="js/busca_nationaldex_roll.js"></script>
    <script>
        const pokemonList = <?php echo json_encode($pokemons, JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="js/autocomplete_national.js"></script>
</body>

</html>