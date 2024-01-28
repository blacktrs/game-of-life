<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife\Cell;

enum CellStatus
{
    public const string CHAR_ALIVE = '0';

    public const string CHAR_DEAD = ' ';

    case DEAD;
    case ALIVE;

    public function getChar(): string
    {
        return $this->name === self::DEAD->name ? self::CHAR_DEAD : self::CHAR_ALIVE;
    }
}
