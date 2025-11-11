<!DOCTYPE html>
<html lang="pt-br">

<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/cabecalho.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabeçalho</title>
</head>

<body>

    <header id="header">

        <nav>
            <ul>
                <button id="main_button" onclick=location.href="index.php">POKÉ GUIDE</button>
                <li class="dropdown">
                    <button class="botao" onclick=location.href="national_dex.php">Pokémon</button>
                    <div class="dropdown-content">
                        <a href="national_dex.php">National Dex</a>
                        <a href="shiny_living_dex.php">Living Dex</a>
                        <a href="pokemon_by_name.php">Pokémon by name</a>
                        <a href="pokemon_lendarios.php">Pokémon Lendários</a>
                        <a href="pokemon_miticos.php">Pokémon Míticos</a>
                        <a href="pokemon_de_eventos.php">Pokémon de Eventos</a>
                        <a href="pokemon__nobre.php">Pokémon Nobre</a>
                        <a href="pokemon_alpha.php">Pokémon Alpha</a>
                        <a href="pokemon_terastal.php">Fenômeno Terastal</a>
                        <a href="pokemon_dynamax.php">Fenômeno Dynamax</a>
                        <a href="pokemon_gigantamax.php">Fenômeno Gigantamax</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="botao" onclick=location.href="mecanicas.php">Mecânicas</button>
                    <div class="dropdown-content">
                        <a href="pokemon_tipos.php">Tipagem</a>
                        <a href="pokemon_habilidades.php">Habilidades</a>
                        <a href="pokemon_natureza.php">Natureza</a>
                        <a href="pokemon_condicoes.php">Condições</a>
                        <a href="pokemon_moves.php">Moves</a>
                        <a href="pokemon_item.php">Itens</a>
                        <a href="sistema_conquistas.php">Sistema de Conquistas</a>
                        <a href="tipo_dano.php">Tipos de Danos</a>
                        <a href="glitches.php">Glitches</a>
                        <a href="menu_guia.php">Guia de Menu</a>
                        <a href="metodo_evolucao.php">Métodos de Evolução</a>
                        <a href="sistema_missao.php">Sistema de missão</a>
                        <a href="condicoes_clima.php">Condições de Clima</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="botao" onclick=location.href="games.php">Games</button>
                    <div class="dropdown-content">
                        <a href="games_portal.php">Games Portal</a>
                        <a href="pokemon_bank.php">Pokémon Bank</a>
                        <a href="pokemon_home.php">Pokémon HOME</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="botao" onclick=location.href="tcg.php">TCG</button>
                    <div class="dropdown-content">
                        <a href="portal_tcg.php">TCG Portal</a>
                        <a href="tcg_sobre.php">Sobre</a>
                        <a href="cards_promocionais.php">Cards Promocionais</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="botao" onclick=location.href="anime_manga.php">Anime & Manga</button>
                    <div class="dropdown-content">
                        <a href="portal_anime.php">Anime Portal</a>
                        <a href="portal_manga.php">Manga Portal</a>
                        <a href="filmes_pokemon.php">Filmes</a>
                        <a href="mangas_pokemon.php">Mangás</a>
                    </div>
                </li>

            </ul>
        </nav>

    </header>
</body>

</html>