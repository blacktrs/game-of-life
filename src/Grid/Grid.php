<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife\Grid;

use Blacktrs\GameOfLife\Cell\CellContainerInterface;

readonly class Grid
{
    public const int BEGIN_X = 1;

    public const int BEGIN_Y = 1;

    public function __construct(
        public int $width,
        public int $height,
        public CellContainerInterface $cells
    ) {
    }
}
