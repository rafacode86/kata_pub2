<?php

require_once __DIR__ . '/Table.php';
require_once __DIR__ . '/Client.php';
require_once __DIR__ . '/Pub.php';

$tables = [
        new Table(1, 2),
        new Table(2, 4),
        new Table(3, 4),
        new Table(4, 6),
        new Table(5, 2),
    ];

$pub = new Pub($tables);

echo "Bienvenido al bar de la IT \n\n";

while (true) {
    echo "---------------------------\n";
    echo "1) Nueva reserva\n";
    echo "2) Legada de cliente\n";
    echo "3) Salir\n";
    echo "Escoge una opción (1-3): ";

    $option = trim(readline());

    if ($option === '1') {
        echo "\n--- Nueva reserva ---\n";
        $client = new Client();
        $pub->processReservation($client);

    } elseif ($option === '2') {
        echo "\n--- Llegada de cliente ---\n";
        $name = readline("Nombre de la reserva hecha: ");
        $pub->clientArrival($name);

    } elseif ($option === '3') {
        echo "\nSaliendo del programa del programa...\n";
        break;

    } else {
        echo "Opción no valida.\n";
    }

    echo "\n";
}