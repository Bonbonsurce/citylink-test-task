<?php

$areas = array (
    1 => '5-й поселок',
    2 => 'Голиковка',
    3 => 'Древлянка',
    4 => 'Заводская',
    5 => 'Зарека',
    6 => 'Ключевая',
    7 => 'Кукковка',
    8 => 'Новый сайнаволок',
    9 => 'Октябрьский',
    10 => 'Первомайский',
    11 => 'Перевалка',
    12 => 'Сулажгора',
    13 => 'Университетский городок',
    14 => 'Центр',
);

$nearby = array (
    1 => array(2,11),
    2 => array(12,3,6,8),
    3 => array(11,13),
    4 => array(10,9,13),
    5 => array(2,6,7,8),
    6 => array(10,2,7,8),
    7 => array(2,6,8),
    8 => array(6,2,7,12),
    9 => array(10,14),
    10 => array(9,14,12),
    11 => array(13,1,9),
    12 => array(1,10),
    13 => array(11,1,8),
    14 => array(9,10),
);

$workers = array (
    0 => array (
        'login' => 'login1',
        'area_name' => 'Октябрьский', //9
    ),
    1 => array (
        'login' => 'login2',
        'area_name' => 'Зарека', //5
    ),
    2 => array (
        'login' => 'login3',
        'area_name' => 'Сулажгора', //12
    ),
    3 => array (
        'login' => 'login4',
        'area_name' => 'Древлянка', //3
    ),
    4 => array (
        'login' => 'login5',
        'area_name' => 'Центр', //14
    ),
);

function getNearestWorkers(string $searchAreaName): array
{
    global $areas, $nearby, $workers;

    $areaKey = array_search($searchAreaName, $areas, true);
    if ($areaKey === false) return [];

    $workersByArea = [];

    foreach ($workers as $worker) {
        $workerAreaKey = array_search($worker['area_name'], $areas, true);

        if ($workerAreaKey !== false) {
            $workersByArea[$workerAreaKey][] = $worker;
        }
    }

    $queue = [$areaKey];
    $head = 0;
    $visited = [$areaKey => true];
    $result = [];
    $distance = [$areaKey => 0];

    while ($head < count($queue)) {
        $currentAreaKey = $queue[$head++];

        if (!empty($workersByArea[$currentAreaKey])) {
            foreach ($workersByArea[$currentAreaKey] as $worker) {
                $result[] = [
                    'login' => $worker['login'],
                    'area_name' => $worker['area_name'],
                    'distance' => $distance[$currentAreaKey],
                ];
            }
        }

        foreach ($nearby[$currentAreaKey] ?? [] as $neighborKey) {
            if (!isset($visited[$neighborKey])) {
                $visited[$neighborKey] = true;

                $distance[$neighborKey] = $distance[$currentAreaKey] + 1;

                $queue[] = $neighborKey;
            }
        }
    }

    return $result;
}

for ($i = 1; $i < count($areas); $i++) {
    echo "Район: $areas[$i] \n";

    $workers = getNearestWorkers($areas[$i]);

    foreach ($workers as $worker) {
        echo $worker['login']
            . ' — '
            . $worker['area_name']
            . ' (расстояние: '
            . $worker['distance']
            . ')'
            . "\n";
    }

    echo "\n";
}