<?php

$intervals = [
    '09:00-11:00',
    '11:00-13:00',
    '15:00-16:00',
    '17:00-20:00',
    '20:30-21:30',
    '21:30-22:30',
    '23:00-02:00',
];

const MINUTES_IN_DAY = 1440;

function validateInterval(string $interval): bool
{
    if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d-([01]\d|2[0-3]):[0-5]\d$/', $interval)) {
        return false;
    }

    return substr($interval, 0, 5) !== substr($interval, 6, 5);
}

function validateIntervalOverlay(string $interval): bool
{
    global $intervals;

    $newSegments = intervalToDaySegments($interval);

    foreach ($intervals as $existingInterval) {
        foreach (intervalToDaySegments($existingInterval) as [$existStart, $existEnd]) {
            foreach ($newSegments as [$newStart, $newEnd]) {
                if ($newStart < $existEnd && $newEnd > $existStart) {
                    return false;
                }
            }
        }
    }

    return true;
}

function timeToMinutes(string $time): int
{
    [$hours, $minutes] = array_map('intval', explode(':', $time));

    return $hours * 60 + $minutes;
}

function intervalToDaySegments(string $interval): array
{
    $start = timeToMinutes(substr($interval, 0, 5));
    $end = timeToMinutes(substr($interval, 6, 5));

    if ($end < $start) {
        return [
            [$start, MINUTES_IN_DAY],
            [0, $end],
        ];
    }

    return [[$start, $end]];
}

$formatTests = [
    ['09:00-11:00', true],
    ['00:00-23:59', true],
    ['23:00-02:00', true],
    ['09:00-09:00', false],
    ['24:00-02:00', false],
    ['12:60-13:00', false],
    ['9:00-11:00', false],
    ['test', false],
    ['', false],
];

$overlapTests = [
    ['08:00-09:00', true],
    ['08:30-09:30', false],
    ['10:00-12:00', false],
    ['13:00-14:00', true],
    ['14:00-16:00', false],
    ['16:00-17:00', true],
    ['19:00-20:30', false],
    ['20:00-20:30', true],
    ['22:30-23:00', true],
    ['01:00-03:00', false],
    ['00:00-01:00', false],
    ['02:00-03:00', true],
    ['22:00-01:00', false],
    ['23:30-01:00', false],
    ['22:30-23:30', false],
];

$passed = 0;
$failed = 0;

echo "Проверка формата:\n";

foreach ($formatTests as [$interval, $expected]) {
    $actual = validateInterval($interval);
    $success = $actual === $expected;

    echo ($success ? 'OK' : 'FAIL') . " $interval\n";

    $success ? $passed++ : $failed++;
}

echo "\nПроверка пересечений:\n";

foreach ($overlapTests as [$interval, $expected]) {
    $actual = validateIntervalOverlay($interval);
    $success = $actual === $expected;

    echo ($success ? 'OK' : 'FAIL') . " $interval\n";

    $success ? $passed++ : $failed++;
}

echo "\nПройдено: $passed, ошибок: $failed\n";