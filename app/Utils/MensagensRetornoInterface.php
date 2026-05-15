<?php

declare(strict_types=1);

namespace App\Utils;

interface MensagensRetornoInterface
{
    public function status(string $status): self;
    public function message(string $title, string $entity): self;
    public function data(array $data): self;
    public function response(int $statusCode = 200): \Illuminate\Http\JsonResponse;
}
