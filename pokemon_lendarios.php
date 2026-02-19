<?php
include 'conexao.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/national_dex.css">
    <link rel="stylesheet" href="css/busca_national.css">
	<link rel="stylesheet" href="css/plendario.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéGuide</title>
</head>

<body>

<?php include 'conexao.php'; include 'cabecalho.php';?> 
<h1 id="titulo">Pokémon Lendários</h1>

<div class="container">
	<p class="paragrafo">São um grupo de Pokémon extremamente raros e frequentemente muito poderosos, geralmente protagonizando lendas e mitos no mundo pokémon.
	Muitos lendários podem ser considerados divindades dentro da espécie Pokémon, e alguns desempenham papéis fundamentais na criação e 
	funcionamento do Mundo Pokémon. Podem assumir formas alternativas e a sua maioria possui gênero indefinido, além de não poderem se reproduzir ou chocarem ovos. Com exceção  de Type: Null, Cosmog e Kubfu, os Pokémon lendários também são conhecidos por não evoluírem.
	identificá-los como pertencentes desse grupo é através de mídias oficiais, como o anime ou os jogos. Uma menção honrosa ao Arcanine é preciso ser feita, afinal, tanto o anime quanto as Dex Entries dele em alguns jogos confirmam que esse Pokémon é considerado um Lendário, apesar de ser encontrado com facilidade na natureza.</p>
	<img src="img/lendarios.jpg" class="img_lendarios">
</div>

<h2 class="subtitulo" id="disponibilidade">Disponibilidade</h2>

<div class="container">
	<p class="paragrafo" id="disponibilidade-text">
		A disponibilidade dos lendários varia conforme a mídia. Nos jogos e mangá, geralmente existe apenas um exemplar de cada lendário, com raras exceções como Heatran, Type: Null e Kubfu. 
		Casos de múltiplas capturas ou batalhas especiais ocorrem apenas por motivos de gameplay. 
		O mangá destaca que manter esses Pokémon em Poké Bolas por muito tempo pode desequilibrar o mundo.
		
		<!-- imagem no meio do texto -->
		<img src="img/lugia.jpg" class="img-float">

		Embora versões de universos paralelos possam existir, como o Celebi shiny de Mystery Dungeon, que é fêmea, diferente do Celebi original. 
		Já o anime adota uma lógica mais flexível, permitindo múltiplos exemplares e até reprodução entre lendários, como Lugia e Latios. 
		Essa ideia já aparecia em Pokémon Snap, que mostra ovos de Articuno, Zapdos e Moltres.
		
		<br><br>
		No entanto, essa abordagem gera diversas contradições narrativas:
		<br><br>
		
		A maioria dos lendários possui descrições ditas como espécies únicas. Tecnicamente, não deveria haver outros exemplares, embora essa lógica
		já foi contrariada no anime. O Lugia é tradicionalmente a ave da torre queimada, mas no anime foi mostrado que existem pelo menos 3 Lugias,
		indo contra a ideia de que só pode existir um pokémon lendário de cada espécie.
		
		<br><br>
		
		Atualmente, existem 2 Mewtwos idênticos no universo do anime, contrariandoa lógica da sua criação.
		
		<br><br>
		<!-- imagem no meio do texto -->
		<img src="img/heatran.jpg" class="img-float-esq">
		
		
		Segundo a Pokedex de 1996, Dratini já foi considerando um pokémon lendário mas perdeu esse status quando foi descoberto uma colônia da espécie.
		Após comprovada a existência de múltiplos indivíduos, esse pokémon deixou de ser lendário e começou a ser considerado apenas como "raro".
		No anime, Dratini e outros pokémon como o Shaymin reforçam essa lógica porém continuam a ser tratados no anime como lendários sem nenhuma
		explicação.
		
		<br><br>
		
		Existem lendários tão numerosos que chegam a ser tratados como Pokémon comuns no anime, sem chamar atenção de treinadores ao redor.
		Como é o caso do Heatran, visto duas vezes sem qualquer alarde. Além disso, no jogo, Heatran apresenta mútliplos indivíduos e inclui machos e fêmeas, 
		o que torna incerto o motivo de ser classificado como lendário. Posteriormente outros lendários e míticos seguiram essa linha de raciocínio, como a linha de Cosmog, 
		que é o primeiro lendário capaz de evoluir, algo que anteriormente era exclusivo de Pokémon não-lendários, já que, de acordo com a teoria do Professor Rowan, 
		lendários já seriam perfeitos e, portanto, não evoluiriam.
		Há casos ainda mais complexos, como Type: Null, que pode evoluir e possui mais de um exemplar. Embora não seja capaz de se reproduzir, o que limita sua população, 
		foi criado um quarto indivíduo posteriormente, mostrando que sua espécie pode ser expandida artificialmente por humanos.
		
		<br><br>
		
		Para explicar essas inconsistências, foi criada uma teoria chamada "Lendário Maior", segundo a qual, mesmo existindo múltiplos exemplares de uma espécies,
		há um indivíduo único e mais poderoso correspondente ao pokémon da lenda. Casos como esse ocorrem com o Lugia, Regice, Regirock e Registeel.
		Com o passar das gerações, as características que definiam a singularidade dos lendários foram progressivamente quebradas. Atualmente, é desconhecido o que realmente 
		classifica um Pokémon como lendário, já que a Game Freak nunca forneceu uma definição clara para corrigir essas contradições.
		
	</p>
	</div>
	
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
foreach ($geracoes as $ger => $info) {
    $inicio = $info['inicio'];
    $fim    = $info['fim'];
    $titulo = $info['titulo'];

    echo "<h2 class='subtitulo' id='gen$ger'>$titulo</h2>";
    echo "<div class='pokedex-grid'>";

    $result = $conn->query("SELECT numero_national, nome_national, tipo1, tipo2, imagem 
                    FROM tb_nationaldex 
                    WHERE numero_national BETWEEN '" . str_pad($inicio, 4, "0", STR_PAD_LEFT) . "' 
                    AND '" . str_pad($fim, 4, "0", STR_PAD_LEFT) . "' 
                    ORDER BY numero_national");

    while ($row = $result->fetch_assoc()) {
        $urlPokemon = "pokemon.php?nome=" . urlencode($row['nome_national']);
        $tipo1Url = "tipo.php?tipo=" . urlencode($row['tipo1']);
        $tipo2Url = isset($row['tipo2']) ? "tipo.php?tipo=" . urlencode($row['tipo2']) : '#';

        echo "<div class='pokemon-card'>
                <div id='numero'>{$row['numero_national']}</div>
                <div class='nome'><a class='link' href='$urlPokemon'>{$row['nome_national']}</a></div>
                <div class='tipos'>
                    <span class='tipo1 " . strtolower($row['tipo1']) . "'>
                        <a class='link' href='$tipo1Url'>{$row['tipo1']}</a>
                    </span>
                    <span class='tipo2 " . strtolower($row['tipo2']) . "'>
                        " . ($row['tipo2'] ? "<a class='link' href='$tipo2Url'>{$row['tipo2']}</a>" : '-') . "
                    </span>
                </div>
                <div class='sprite'><a href='$urlPokemon'><img src='{$row['imagem']}' alt='{$row['nome_national']}'></a></div>
              </div>";
    }
    echo "</div>";
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
</body>
</html>
