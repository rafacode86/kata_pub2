<?php

class Table {

    private int $id;
    private int $chairs;
    private bool $reserved = false;

    public function __construct(int $id, int $chairs, bool $reserved = false) {
        $this->id = $id;
        $this->chairs = $chairs;
        $this->reserved = $reserved;

    }

    public function getId(): int {
        return $this->id;
    }
    public function getChairs(): int {
        return $this->chairs;
    }
    public function getReserved(): bool {
        return $this->reserved;
    }
    public function setReserved(bool $reserved): void {
        $this->reserved = $reserved;
    }

}