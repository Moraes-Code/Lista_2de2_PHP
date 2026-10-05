<?php

function ordenar($agenda) {
    usort($agenda, fn($a, $b) => strcmp($a["horario"], $b["horario"]));
    return $agenda;
}

function pacientes($agenda) {
    return count(array_unique(array_column($agenda, "paciente")));
}

function especialidades($agenda) {
    return array_count_values(array_column($agenda, "especialidade"));
}

function pesquisar($agenda, $nome) {
    return array_filter($agenda, fn($c) => 
        strtolower($c["paciente"]) == strtolower($nome)
    );
}

function horariosDuplicados($agenda) {
    $horarios = array_column($agenda, "horario");
    return count($horarios) != count(array_unique($horarios));
}

function organizarAgenda($agenda, $nome) {
    $agenda = ordenar($agenda);

    return [
        "Total de consultas" => count($agenda),
        "Pacientes diferentes" => pacientes($agenda),
        "Por especialidade" => especialidades($agenda),
        "Primeiro atendimento" => $agenda[0],
        "Último atendimento" => end($agenda),
        "Agenda ordenada" => $agenda,
        "Pesquisa" => pesquisar($agenda, $nome),
        "Horários duplicados" => horariosDuplicados($agenda)
    ];
}

$agenda = [
    ["paciente" => "João", "especialidade" => "Cardiologia", "data" => "10/08/2026", "horario" => "08:00"],
    ["paciente" => "Maria", "especialidade" => "Dermatologia", "data" => "10/08/2026", "horario" => "09:30"],
    ["paciente" => "João", "especialidade" => "Cardiologia", "data" => "10/08/2026", "horario" => "11:00"]
];

print_r(organizarAgenda($agenda, "João"));
?>