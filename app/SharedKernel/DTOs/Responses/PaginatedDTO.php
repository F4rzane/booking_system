<?php

namespace App\SharedKernel\DTOs\Responses;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class PaginatedDTO extends DataTransferObject
{
    // public array|Collection $data;
    public ?int $current_page;
    public string $first_page_url;
    public ?int $from;
    public ?int $last_page;
    public ?string $last_page_url;
    // public array $links;
    public ?string $next_page_url;
    public string $path;
    public int $per_page;
    public ?string $prev_page_url;
    public ?int $to;
    public ?int $total;
}
