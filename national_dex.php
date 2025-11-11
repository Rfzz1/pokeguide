<?php
include 'conexao.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'funcoes_imagem.php'; // adicione no topo do national_dex.php

// Definindo intervalos de cada geração
$geracoes = [
    1 => ['inicio' => 1, 'fim' => 151, 'titulo' => 'Geração 1'],
    2 => ['inicio' => 152, 'fim' => 251, 'titulo' => 'Geração 2'],
    3 => ['inicio' => 252, 'fim' => 386, 'titulo' => 'Geração 3'],
    4 => ['inicio' => 387, 'fim' => 493, 'titulo' => 'Geração 4'],
    5 => ['inicio' => 494, 'fim' => 649, 'titulo' => 'Geração 5'],
    6 => ['inicio' => 650, 'fim' => 721, 'titulo' => 'Geração 6'],
    7 => ['inicio' => 722, 'fim' => 809, 'titulo' => 'Geração 7'],
    8 => ['inicio' => 810, 'fim' => 898, 'titulo' => 'Geração 8'],
    9 => ['inicio' => 899, 'fim' => 1010, 'titulo' => 'Geração 9']
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Dex</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Chelsea+Market&family=Alan+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/national_dex.css">
    <link rel="stylesheet" href="css/menu.geracoes.css">
    <link rel="stylesheet" href="css/busca_national.css">

    <link rel="icon" href="img/pokedex.png" type="image/png">
</head>

<body>

    <?php include 'cabecalho.php'; ?>

    <!-- Botão hambúrguer -->
    <div class="menu-hamburguer" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Menu lateral -->
    <nav id="menu-lateral">
        <ul>
            <?php
            foreach ($geracoes as $ger => $info):
            ?>
                <li><a href="#gen<?php echo $ger; ?>"><?php echo $info['titulo']; ?></a></li>
            <?php
            endforeach;
            ?>
        </ul>
    </nav>

    <!-- CONTAINER TÍTULO + BUSCA -->
    <div class="header-container">
        <h1 id="titulo">Pokémon por Número na National Dex</h1>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar Pokémon...">
            <button id="searchButton">🔍</button>
            <ul id="suggestions" class="suggestions-list"></ul>
        </div>
    </div>

    <?php
    // Gerando as tabelas da Pokédex
    foreach ($geracoes as $ger => $info) {
        $inicio = $info['inicio'];
        $fim    = $info['fim'];
        $titulo = $info['titulo'];

        echo "<h2 class='subtitulo' id='gen$ger'>$titulo</h2>";
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
                        WHERE numero_national BETWEEN '" . str_pad($inicio, 4, "0", STR_PAD_LEFT) . "' 
                        AND '" . str_pad($fim, 4, "0", STR_PAD_LEFT) . "' 
                        ORDER BY numero_national");

        while ($row = $result->fetch_assoc()) {
            $urlPokemon = "pokemon.php?nome=" . urlencode($row['nome_national']);
            $tipo1Url = "tipo.php?tipo=" . urlencode($row['tipo1']);
            $tipo2Url = isset($row['tipo2']) ? "tipo.php?tipo=" . urlencode($row['tipo2']) : '#';

            echo "<tr>
                <td id='numero'>{$row['numero_national']}</td>
                <td class='nome'><a class='link' href='$urlPokemon'>{$row['nome_national']}</a></td>
                <td class='tipo1 " . strtolower($row['tipo1']) . "'>
                    <a class='link' href='$tipo1Url'>{$row['tipo1']}</a>
                </td>
                <td class='tipo2 " . strtolower($row['tipo2']) . "'>" .
                ($row['tipo2'] ? "<a class='link' href='$tipo2Url'>{$row['tipo2']}</a>" : '-') .
                "</td>
                <td><a href='$urlPokemon'><img src='{$row['imagem']}' alt='{$row['nome_national']}'></a></td>
              </tr>";
        }
        echo "</table>";
    }

    // ARRAY DE POKÉMONS PARA AUTOCOMPLETE
    $pokemons = [];
    $result = $conn->query("SELECT nome_national, tipo1, tipo2, imagem FROM tb_nationaldex ORDER BY numero_national");
    while ($row = $result->fetch_assoc()) {
        $pokemons[] = [
            'name'   => $row['nome_national'],
            'tipo1'  => $row['tipo1'],
            'tipo2'  => $row['tipo2'],
            'sprite' => $row['imagem']
        ];
    }
    $conn->close();
    ?>

    <script src="js/menu_hamburguer.js"></script>
    <script src="js/busca_nationaldex_roll.js"></script>
    <script>
        const pokemonList = <?php echo json_encode($pokemons); ?>;
    </script>
    <script src="js/autocomplete_national.js"></script>