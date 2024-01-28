<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife\Cell;

class CellContainer implements CellContainerInterface
{
    /**
     * @return array<int, CellStatus[]>
     */
    private array $cells = [];

    public function get(int $x, int $y): CellStatus
    {
        return $this->cells[$y][$x];
    }

    public function set(int $x, int $y, CellStatus $status): void
    {
        $this->cells[$y][$x] = $status;
    }

    /**
     * @return array<int, CellStatus[]>
     */
    public function getAll(): array
    {
        return $this->cells;
    }

    public function setAlive(int $x, int $y): void
    {
        $this->set($x, $y, CellStatus::ALIVE);
    }

    public function setDead(int $x, int $y): void
    {
        $this->set($x, $y, CellStatus::DEAD);
    }

    public function isAlive(int $x, int $y): bool
    {
        return $this->get($x, $y) === CellStatus::ALIVE;
    }
}
