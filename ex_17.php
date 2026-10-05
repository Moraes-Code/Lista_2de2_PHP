<?php

function palavras($texto) {
    $texto = preg_replace('/[,.!?;:]/', '', $texto);
    return array_filter(explode(' ', strtolower(trim($texto))));
}

function caracteres($texto) {
    return strlen($texto);
}

function frases($texto) {
    return preg_match_all('/[.!?]+/', $texto);
}

function maiorMenor($palavras) {
    usort($palavras, fn($a, $b) => strlen($a) <=> strlen($b));

    return [
        "Maior" => end($palavras),
        "Menor" => reset($palavras)
    ];
}



function maisFrequentes($palavras) {
    $contagem = array_count_values($palavras);
    arsort($contagem);
    return array_slice($contagem, 0, 5, true);
}

function processarTexto($texto) {
    $palavras = palavras($texto);
    $tamanho = maiorMenor($palavras);

    return [
        "Caracteres" => caracteres($texto),
        "Palavras" => count($palavras),
        "Frases" => frases($texto),
        "Palavra mais longa" => $tamanho["Maior"],
        "Palavra mais curta" => $tamanho["Menor"],
        "Palavras repetidas" => count(repetidas($palavras)),
        "5 mais frequentes" => maisFrequentes($palavras),
        "Sem espaços duplicados" => preg_replace('/\s+/', ' ', trim($texto)),
        "Formatado" => ucwords(strtolower($texto))
    ];
}

print_r(processarTexto("php é simples. php é muito simples!"));?>