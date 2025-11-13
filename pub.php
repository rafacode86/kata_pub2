<?php

class Pub {

    private array $tables = [];
    private array $reservations = [];

    public function __construct(array $tables) {
        $this->tables = $tables;
        $this->reservations = [];
    }

    public function getTables(): array {
        return $this->tables;  
    }

    public function addTable(Table $table): void {
        $this->tables[] = $table;
    }

    public function makeReservation(Client $client): ?Table {
        $people = $client->getPeople();

        foreach ($this->tables as $table) {
            if (!$table->getReserved() && $table->getChairs() >= $people) {
                $table->setReserved(true);

                $this->reservations[] = [
                    'name'    => $client->getName(),
                    'people'  => $client->getPeople(),
                    'tableId' => $table->getId(),
                    'arrived' => false,
                ];

                return $table;
            }
        }

        return null;
    }

    public function processReservation(Client $client): void {
        $table = $this->makeReservation($client);

        if ($table === null) {
            echo "Lo sentimos, no hay ninguna mesa disponible per a {$client->getPeople()} persones.\n";
        } else {
            echo "Reserva hecha!\n";
            echo "Nombre: {$client->getName()}\n";
            echo "Numero de mesa: {$table->getId()} \n";
        }
    }

    private function findReservationIndexByName(string $name): ?int {
        $name = trim(strtolower($name));

        foreach ($this->reservations as $index => $reservation) {
            if (strtolower($reservation['name']) === $name) {
                return $index;
            }
        }

        return null;
    }

    public function clientArrival(string $name): void {
        $index = $this->findReservationIndexByName($name);

        if ($index === null) {
            echo "No hemos encontrado reserva a nombre de: {$name}.\n";
            return;
        }

        // Si ja havia arribat abans
        if ($this->reservations[$index]['arrived'] === true) {
            echo "El/la cliente/a {$this->reservations[$index]['name']} ya esta en el local.\n";
            return;
        }

        // Marquem que ja ha arribat
        $this->reservations[$index]['arrived'] = true;

        $tableId = $this->reservations[$index]['tableId'];
        $people  = $this->reservations[$index]['people'];

        echo "Benvenido/a, {$this->reservations[$index]['name']}!\n";
        echo "Su mesa es la {$tableId} para {$people} personas. Puede acceder al local.\n";
    }

    public function getReservations(): array {
        return $this->reservations;
    }
}
