<?php
include 'conexao.php';
include 'funcoes_imagem.php'; // Função de imagens
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Gerações
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
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiny Living Form Dex</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/national_dex.css">
    <link rel="stylesheet" href="css/menu.geracoes.css">
    <link rel="stylesheet" href="css/busca.css">
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
        <h1 id="titulo">Shiny Living Form Dex</h1>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar Pokémon (forma)...">
            <button id="searchButton">🔍</button>
            <ul id="suggestions" class="suggestions-list"></ul>
        </div>
    </div>

    <?php
    $pokeArray = [];

    foreach ($geracoes as $ger => $info) {
        $inicio = str_pad($info['inicio'], 4, "0", STR_PAD_LEFT);
        $fim = str_pad($info['fim'], 4, "0", STR_PAD_LEFT);

        echo "<h2 class='subtitulo' id='gen$ger'>{$info['titulo']}</h2>";
        echo "<table id='tabela'>
        <tr>
            <th>#</th>
            <th>Nome (Forma)</th>
            <th>Tipo 1</th>
            <th>Tipo 2</th>
            <th>Normal</th>
            <th>Shiny</th>
        </tr>";

        $sql = "SELECT numero_national, nome_national, form_name, variety_name, tipo1, tipo2,
                imagem_normal, imagem_normal_female,
                imagem_shiny, imagem_shiny_female
            FROM tb_shiny_livingdex
            WHERE numero_national BETWEEN '$inicio' AND '$fim'
            ORDER BY numero_national, pokeapi_id";

        $res = $conn->query($sql);

        while ($row = $res->fetch_assoc()) {
            $nome = $row['nome_national'] ?? '';
            $formName = $row['form_name'] ?? '';
            $variety = $row['variety_name'] ?? '';
            $numero = $row['numero_national'] ?? '';
            $tipo1 = $row['tipo1'] ?? '-';
            $tipo2 = $row['tipo2'] ?? '-';
            $displayName = $nome . ($formName ? " ({$formName})" : '');
            $urlPokemon = "pokemon.php?nome=" . urlencode($nome) . "&variety=" . urlencode($variety);

            // imagens
            $img_normal    = getPokemonImage($row['imagem_normal'], $row['imagem_shiny'], $row['imagem_normal_female'], $row['imagem_shiny_female'], 'normal');
            $img_shiny     = getPokemonImage($row['imagem_shiny'], null, null, null, 'shiny');
            $img_normal_f  = getPokemonImage($row['imagem_normal'], null, $row['imagem_normal_female'], null, 'normal_f');
            $img_shiny_f   = getPokemonImage($row['imagem_shiny'], null, null, $row['imagem_shiny_female'], 'shiny_f');

            // linha normal
            $rowId = 'pokemon-' . strtolower(preg_replace('/[^a-z0-9]+/i', '-', $variety ?: $nome));
            echo "<tr id='{$rowId}'>
            <td>{$numero}</td>
            <td class='nome'><a class='link' href='$urlPokemon'>{$displayName}</a></td>
            <td class='tipo1 " . strtolower($tipo1) . "'>" . ($tipo1 ?: '-') . "</td>
            <td class='tipo2 " . strtolower($tipo2) . "'>" . ($tipo2 ?: '-') . "</td>
            <td><a href='$urlPokemon'><img src='{$img_normal}' alt='Normal {$displayName}'></a></td>
            <td><a href='$urlPokemon'><img src='{$img_shiny}' alt='Shiny {$displayName}'></a></td>
        </tr>";

            // adiciona ao array JS
            $pokeArray[] = [
                'display' => $displayName,
                'variety' => $variety,
                'name' => $nome,
                'sprite' => $img_normal,
                'tipo1' => $tipo1,
                'tipo2' => $tipo2
            ];

            // linha feminina
            if ($row['imagem_normal_female'] || $row['imagem_shiny_female']) {
                $displayFemale = $nome . ($formName ? " ({$formName} Fêmea)" : " (Fêmea)");
                $rowIdFemale = 'pokemon-' . strtolower(preg_replace('/[^a-z0-9]+/i', '-', ($variety ? $variety . '-female' : $nome . '-female')));

                echo "<tr class='female' id='{$rowIdFemale}'>
                <td>{$numero}</td>
                <td class='nome'><a class='link' href='$urlPokemon'>{$displayFemale}</a></td>
                <td class='tipo1 " . strtolower($tipo1) . "'>" . ($tipo1 ?: '-') . "</td>
                <td class='tipo2 " . strtolower($tipo2) . "'>" . ($tipo2 ?: '-') . "</td>
                <td><a href='$urlPokemon'><img src='{$img_normal_f}' alt='Normal {$displayFemale}'></a></td>
                <td><a href='$urlPokemon'><img src='{$img_shiny_f}' alt='Shiny {$displayFemale}'></a></td>
            </tr>";

                $pokeArray[] = [
                    'display' => $displayFemale,
                    'variety' => $variety ? ($variety . '-female') : ($nome . '-female'),
                    'name' => $nome,
                    'sprite' => $img_normal_f,
                    'tipo1' => $tipo1,
                    'tipo2' => $tipo2
                ];
            }
        }

        echo "</table>";
    }

    $conn->close();
    ?>

    <script src="js/menu_hamburguer.js"></script>
    <script src="js/busca_shinylivingdex.js"></script>
    <script>
        const pokemonList = <?php echo json_encode($pokeArray, JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="js/autocomplete_shiny.js"></script>
</body>

</html>