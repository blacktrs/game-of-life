#!/usr/bin/env php

<?php

use Blacktrs\GameOfLife\Cell\CellContainer;
use Blacktrs\GameOfLife\Game;
use Blacktrs\GameOfLife\Grid\{Grid, GridProvider, GridRenderer};

require __DIR__ . '/vendor/autoload.php';

parse_str(implode('&', \array_slice($argv, 1)), $args);
$width = (int) ($args['--width'] ?? exec('tput cols'));
$height = (int) ($args['--height'] ?? exec('tput lines'));
$frameDuration = (float) ($args['--frame-duration'] ?? 0.1);

$grid = new Grid($width, $height, new CellContainer());
$gridProcessor = new GridProvider($grid, __DIR__ . '/var/templates/glider');

(new Game($gridProcessor, new GridRenderer()))->run($frameDuration);