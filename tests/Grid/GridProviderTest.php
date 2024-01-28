<?php declare(strict_types=1);

namespace Blacktrs\GameOfLife\Tests\Grid;

use Blacktrs\GameOfLife\Cell\{CellContainer, CellStatus};
use Blacktrs\GameOfLife\Grid\{Grid, GridProvider};
use PHPUnit\Framework\TestCase;
use function dirname;

class GridProviderTest extends TestCase
{
    private GridProvider $provider;

    protected function setUp(): void
    {
        $grid = new Grid(25, 25, new CellContainer());
        $this->provider = new GridProvider($grid, dirname(__DIR__, 2) .'/var/templates/glider');
    }

    public function testGridPopulation(): void
    {
        $this->provider->populateGrid();

        $cells = $this->provider->getGrid()->cells;

        static::assertCount(25, $cells->getAll());
        static::assertSame(CellStatus::CHAR_DEAD, $cells->get(1, 1)->getChar());
        static::assertSame(CellStatus::CHAR_DEAD, $cells->get(2, 2)->getChar());
        static::assertSame(CellStatus::CHAR_ALIVE, $cells->get(2, 3)->getChar());
        static::assertSame(CellStatus::CHAR_ALIVE, $cells->get(3, 1)->getChar());
        static::assertSame(CellStatus::CHAR_ALIVE, $cells->get(3, 3)->getChar());
        static::assertSame(CellStatus::CHAR_DEAD, $cells->get(3, 4)->getChar());

    }

    public function testNewGeneration(): void
    {
        $this->provider->populateGrid();
        $this->provider->populateNewGeneration();

        $cells = $this->provider->getGrid()->cells;

        static::assertCount(25, $cells->getAll());
        static::assertSame(CellStatus::CHAR_DEAD, $cells->get(1, 1)->getChar());
        static::assertSame(CellStatus::CHAR_ALIVE, $cells->get(2, 2)->getChar());
        static::assertSame(CellStatus::CHAR_DEAD, $cells->get(2, 3)->getChar());
        static::assertSame(CellStatus::CHAR_ALIVE, $cells->get(3, 3)->getChar());
        static::assertSame(CellStatus::CHAR_ALIVE, $cells->get(3, 4)->getChar());
    }
}