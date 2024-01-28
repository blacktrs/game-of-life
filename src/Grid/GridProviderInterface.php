<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife\Grid;

interface GridProviderInterface
{
    public function populateGrid(): void;

    public function populateNewGeneration(): void;

    public function getGrid(): Grid;

    public function reachedEndPosition(): bool;
}
