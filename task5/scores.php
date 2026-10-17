<?php

header('Content-Type: application/json; charset=utf-8');

$request = json_decode(file_get_contents('php://input'), true);
$names = is_array($request['names'] ?? null) ? $request['names'] : [];

$scores = array_map( static function () {
    return random_int(0, 100);
}, $names);

echo json_encode($scores);
