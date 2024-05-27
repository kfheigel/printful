<?php

declare(strict_types=1);

namespace App\Domain\HttpClient;

interface PrintfulClientInterface
{
    public function getProductVariants(): ?string;
}
