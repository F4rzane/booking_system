<?php

namespace App\SharedKernel\Services\Contracts;

interface DataBagInterface
{
    public function all(): array;

    public function get(string $key, $default = null): mixed;

    public function set($key, $value): void;

    public function only(...$keys): array;

    public function except(...$keys): array;

    public function has(...$keys): bool;

    public function hasAny(...$keys): bool;

    public function missing(...$keys): bool;

    public function missingAny(...$keys): bool;
}
