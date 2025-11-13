<?php

    class Client {
        
        private string $name;
        private int $people;

        public function __construct() {
            $this->name = $this->askName();
            $this->people = $this->askPeople();
        }

        private function askName(): string {
        $name = "";

        while (trim($name) === "") {
            $name = readline("Nombre de la reserva: ");
        }

        return $name;
        }

        private function askPeople(): int {
        $people = 0;

        do {
            $people = (int) readline("Cuantes persones sereis? ");
        } while ($people < 1);

        return $people;
    }

        public function getName(): string {
            return $this->name;
        }

        public function getPeople(): int {
            return $this->people;
        }
    }

?>