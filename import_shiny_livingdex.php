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
    echo "<h2>Importando Shiny Living Dex - Geração $geracao</h2>";
} else {
    $inicio = 1;
    $fim    = 1025;
    echo "<h2>Importando Shiny Living Dex - Todas as Gerações</h2>";
}

/* -------------------------------
   Função para tratar imagens
---------------------------------*/
function getImage($url)
{
    return $url ? $url : NULL;
}

/* -------------------------------
   Função para inserir Pokémon
---------------------------------*/
function insert_pokemon(
    $conn,
    $id_national_sql,
    $numero,
    $nome_national,
    $variety_name,
    $form_name_sql,
    $pokeapi_id,
    $tipo1_sql,
    $tipo2_sql,
    $img_normal,
    $img_normal_female,
    $img_shiny,
    $img_shiny_female,
    $is_shiny_available
) {

    $img_normal_sql        = $img_normal ? "'" . $conn->real_escape_string($img_normal) . "'" : "NULL";
    $img_normal_f_sql      = $img_normal_female ? "'" . $conn->real_escape_string($img_normal_female) . "'" : "NULL";
    $img_shiny_sql         = $img_shiny ? "'" . $conn->real_escape_string($img_shiny) . "'" : "NULL";
    $img_shiny_f_sql       = $img_shiny_female ? "'" . $conn->real_escape_string($img_shiny_female) . "'" : "NULL";

    // Evita duplicados
    $check = $conn->query("SELECT id_shiny FROM tb_shiny_livingdex WHERE pokeapi_id = $pokeapi_id AND variety_name = '" . $conn->real_escape_string($variety_name) . "'");
    if ($check && $check->num_rows > 0) return;

    $sql = "INSERT INTO tb_shiny_livingdex
    (id_national, numero_national, nome_national, variety_name, form_name, pokeapi_id, tipo1, tipo2,
     imagem_normal, imagem_normal_female, imagem_shiny, imagem_shiny_female, is_shiny_available, origem)
    VALUES
    ($id_national_sql, '$numero', '$nome_national', '" . $conn->real_escape_string($variety_name) . "',
     $form_name_sql, $pokeapi_id, $tipo1_sql, $tipo2_sql,
     $img_normal_sql, $img_normal_f_sql, $img_shiny_sql, $img_shiny_f_sql, $is_shiny_available, 'pokeapi')";

    $conn->query($sql);
}

/* -------------------------------
   Loop principal
---------------------------------*/
for ($i = $inicio; $i <= $fim; $i++) {
    $numero = str_pad($i, 4, "0", STR_PAD_LEFT);
    echo "<h3>Processando #$numero</h3>";

    $url_species = "https://pokeapi.co/api/v2/pokemon-species/$i/";
    $ch = curl_init($url_species);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $resp_species = curl_exec($ch);
    curl_close($ch);

    if (!$resp_species) continue;
    $data_species = json_decode($resp_species, true);
    if (!$data_species) continue;

    $species_name = $data_species['name'];

    // Busca nome no banco
    $nome_national = null;
    $id_national = null;
    $q = $conn->query("SELECT id_national, nome_national FROM tb_nationaldex WHERE numero_national = '$numero' LIMIT 1");
    if ($q && $q->num_rows > 0) {
        $row = $q->fetch_assoc();
        $nome_national = $conn->real_escape_string($row['nome_national']);
        $id_national = intval($row['id_national']);
    } else {
        $nome_national = $conn->real_escape_string($species_name);
    }

    $id_national_sql = $id_national ? $id_national : "NULL";

    if (!isset($data_species['varieties']) || !is_array($data_species['varieties'])) continue;

    foreach ($data_species['varieties'] as $var) {
        $variety_name = $var['pokemon']['name'];
        $url_pokemon = $var['pokemon']['url'];

        $ch = curl_init($url_pokemon);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        $resp_poke = curl_exec($ch);
        curl_close($ch);

        if (!$resp_poke) continue;
        $data_poke = json_decode($resp_poke, true);
        if (!$data_poke) continue;

        $pokeapi_id = intval($data_poke['id']);

        $form_name = ($variety_name !== $species_name)
            ? "'" . $conn->real_escape_string(ucwords(str_replace(['-', '_'], ' ', $variety_name))) . "'"
            : "NULL";

        $sprites = $data_poke['sprites'] ?? [];

        $img_normal        = getImage($sprites['front_default'] ?? null);
        $img_normal_female = getImage($sprites['front_female'] ?? null);
        $img_shiny         = getImage($sprites['front_shiny'] ?? null);
        $img_shiny_female  = getImage($sprites['front_shiny_female'] ?? null);

        $tipo1 = $data_poke['types'][0]['type']['name'] ?? null;
        $tipo2 = $data_poke['types'][1]['type']['name'] ?? null;
        $tipo1_sql = $tipo1 ? "'" . $conn->real_escape_string($tipo1) . "'" : "NULL";
        $tipo2_sql = $tipo2 ? "'" . $conn->real_escape_string($tipo2) . "'" : "NULL";

        $is_shiny_available = ($img_shiny || $img_shiny_female) ? 1 : 0;

        insert_pokemon(
            $conn,
            $id_national_sql,
            $numero,
            $nome_national,
            $variety_name,
            $form_name,
            $pokeapi_id,
            $tipo1_sql,
            $tipo2_sql,
            $img_normal,
            $img_normal_female,
            $img_shiny,
            $img_shiny_female,
            $is_shiny_available
        );

        usleep(300000);
    }

    flush();
    sleep(1);
}

$conn->close();
echo "<h3>Importação concluída!</h3>";
?>