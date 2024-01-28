<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife\Cell;

interface CellContainerInterface
{
    public function get(int $x, int $y): CellStatus;

    public function set(int $x, int $y, CellStatus $status): void;

    public function getAll(): array;

    public function setAlive(int $x, int $y): void;

    public function setDead(int $x, int $y): void;

    public function isAlive(int $x, int $y): bool;
}
