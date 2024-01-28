<?php declare(strict_types=1);

namespace Blacktrs\GameOfLife\Grid;

use Blacktrs\GameOfLife\Cell\CellStatus;

class GridRenderer implements GridRendererInterface
{
    public function render(Grid $grid): void
    {
        foreach ($grid->cells->getAll() as $row) {
            $output = '';
            /** @var CellStatus $cell */
            foreach ($row as $cell) {
                $output .= $cell->getChar();
            }

             fwrite(STDOUT, $output.PHP_EOL);
        }
    }

    public function resetFrame(): void
    {
        fwrite(STDOUT, "\033[0;0H");
    }
}