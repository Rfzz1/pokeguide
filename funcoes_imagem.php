<?php
/**
 * Retorna a imagem correta de um Pokémon ou fallback se não existir.
 *
 * @param string|null $imgNormal       Imagem normal.
 * @param string|null $imgShiny        Imagem shiny.
 * @param string|null $imgNormalF      Imagem normal feminina.
 * @param string|null $imgShinyF       Imagem shiny feminina.
 * @param string $tipo                 Tipo de imagem: 'normal', 'shiny', 'normal_f', 'shiny_f'.
 * @return string                       URL da imagem a ser usada.
 */
function getPokemonImage($imgNormal, $imgShiny = null, $imgNormalF = null, $imgShinyF = null, $tipo = 'normal') {
    $fallback = 'img/fallback.png'; // caminho da imagem fallback

    switch ($tipo) {
        case 'shiny':        return $imgShiny ?: $fallback;
        case 'normal_f':     return $imgNormalF ?: $fallback;
        case 'shiny_f':      return $imgShinyF ?: $fallback;
        case 'normal':
        default:             return $imgNormal ?: $fallback;
    }
}
// Retorna a melhor imagem disponível
function getPokemonImageN($img_normal, $img_shiny = null, $img_normal_f = null, $img_shiny_f = null, $tipo = 'normal') {
    switch ($tipo) {
        case 'normal_f': return $img_normal_f ?: $img_normal ?: 'img/placeholder.png';
        case 'shiny': return $img_shiny ?: $img_normal ?: 'img/placeholder.png';
        case 'shiny_f': return $img_shiny_f ?: $img_shiny ?: $img_normal ?: 'img/placeholder.png';
        default: return $img_normal ?: 'img/placeholder.png';
    }
}


?>
