<?php

function contarMaiusculas($senha) {
    return preg_match_all('/[A-Z]/', $senha);
}

function contarMinusculas($senha) {
    return preg_match_all('/[a-z]/', $senha);
}

function contarNumeros($senha) {
    return preg_match_all('/[0-9]/', $senha);
}

function contarEspeciais($senha) {
    return preg_match_all('/[^a-zA-Z0-9]/', $senha);
}

function classificarSenha($senha) {
    $pontos = 0;

    if (strlen($senha) >= 8) $pontos++;
    if (contarMaiusculas($senha)) $pontos++;
    if (contarMinusculas($senha)) $pontos++;
    if (contarNumeros($senha)) $pontos++;
    if (contarEspeciais($senha)) $pontos++;

    if ($pontos == 5) return "Muito Forte";
    if ($pontos == 4) return "Forte";
    if ($pontos == 3) return "Média";
    return "Fraca";
}

function analisarSenha($senha) {
    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Segurança" => classificarSenha($senha)
    ];
}

print_r(analisarSenha("Senha@123"));
?>