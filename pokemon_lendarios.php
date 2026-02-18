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
</body>
</html>
