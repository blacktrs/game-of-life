<?php

declare(strict_types=1);

namespace Blacktrs\GameOfLife;

use Blacktrs\GameOfLife\Grid\{GridProviderInterface, GridRendererInterface};

readonly class Game
{
    public function __construct(
        private GridProviderInterface $gridProvider,
        private GridRendererInterface $gridRenderer
    ) {
    }

    public function run(float $frameDuration = 0.1): void
    {
        $this->gridProvider->populateGrid();

        do {
            $this->gridRenderer->render($this->gridProvider->getGrid());
            $this->gridRenderer->resetFrame();
            $this->gridProvider->populateNewGeneration();
            usleep((int)($frameDuration * 1_000_000));
        } while(!$this->gridProvider->reachedEndPosition());
    }
}
