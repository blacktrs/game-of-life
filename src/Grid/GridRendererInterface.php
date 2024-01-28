<?php declare(strict_types=1);

namespace Blacktrs\GameOfLife\Grid;

interface GridRendererInterface
{
    public function render(Grid $grid): void;

    public function resetFrame(): void;
}