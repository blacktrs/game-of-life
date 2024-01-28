<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife\Grid;

use Blacktrs\GameOfLife\Cell\CellStatus;

readonly class GridProvider implements GridProviderInterface
{
    public function __construct(private Grid $grid, private string $template)
    {
    }

    public function populateGrid(): void
    {
        $this->populateEmpty();
        $fp = fopen($this->template, 'rb');

        $x = Grid::BEGIN_X;
        $y = Grid::BEGIN_Y;

        while (($char = fgetc($fp)) !== false) {
            if ($char === CellStatus::CHAR_ALIVE) {
                $this->grid->cells->setAlive($x, $y);
            }

            if ($char === PHP_EOL) {
                ++$y;
                $x = Grid::BEGIN_X;
            } else {
                ++$x;
            }
        }

        fclose($fp);
    }

    public function populateNewGeneration(): void
    {
        $deadCells = $aliveCells = [];

        for ($y = 0; $y < $this->grid->height; ++$y) {
            for ($x = 0; $x < $this->grid->width; ++$x) {
                $aliveNeighborCount = $this->getAliveNeighborCount($x, $y);

                if ($this->grid->cells->isAlive($x, $y) && ($aliveNeighborCount < 2 || $aliveNeighborCount > 3)) {
                    $deadCells[] = [$x, $y];
                }

                if (!$this->grid->cells->isAlive($x, $y) && $aliveNeighborCount === 3) {
                    $aliveCells[] = [$x, $y];
                }
            }
        }

        foreach ($deadCells as [$x, $y]) {
            $this->grid->cells->setDead($x, $y);
        }

        foreach ($aliveCells as [$x, $y]) {
            $this->grid->cells->setAlive($x, $y);
        }
    }

    private function getAliveNeighborCount(int $x, int $y): int
    {
        $aliveCount = 0;

        for ($y2 = $y - 1; $y2 <= $y + 1; ++$y2) {
            if ($y2 < 0 || $y2 >= $this->grid->height) {
                continue;
            }

            for ($x2 = $x - 1; $x2 <= $x + 1; ++$x2) {
                if ($x2 === $x && $y2 === $y) {
                    continue;
                }

                if ($x2 < 0 || $x2 >= $this->grid->width) {
                    continue;
                }

                if ($this->grid->cells->isAlive($x2, $y2)) {
                    $aliveCount++;
                }
            }
        }

        return $aliveCount;
    }

    private function populateEmpty(): void
    {
        for ($x = 0; $x < $this->grid->width; ++$x) {
            for ($y = 0; $y < $this->grid->height; ++$y) {
                $this->grid->cells->setDead($x, $y);
            }
        }
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function reachedEndPosition(): bool
    {
        return $this->grid->cells->isAlive($this->grid->width - 1, $this->grid->height - 1);
    }
}
