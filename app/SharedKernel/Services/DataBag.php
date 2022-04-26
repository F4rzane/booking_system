<?php

namespace App\SharedKernel\Services;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use App\SharedKernel\Services\Contracts\DataBagInterface;
use App\SharedKernel\Services\Exceptions\DataBagException;

class DataBag implements DataBagInterface, Arrayable, ArrayAccess
{
    public function __construct(protected array $data = [])
    {
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return $this->getData();
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset): mixed
    {
        if ($this->offsetExists($offset)) {
            return $this->data[$offset];
        }

        throw DataBagException::undefined($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    public function all(): array
    {
        return $this->toArray();
    }

    public function get(string $key, $default = null): mixed
    {
        try {
            return $this->offsetGet($key);
        } catch (DataBagException $ex) {
            return $default;
        }
    }

    public function set($key, $value): void
    {
        $this->offsetSet($key, $value);
    }

    public function only(...$keys): array
    {
        $results = [];

        if (func_num_args() === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        foreach ($keys as $key) {
            if ($this->offsetExists($key)) {
                $results[$key] = $this->get($key);
            }
        }

        return $results;
    }

    public function except(...$keys): array
    {
        $results = $this->all();

        if (func_num_args() === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        foreach ($keys as $key) {
            unset($results[$key]);
        }

        return $results;
    }

    public function has(...$keys): bool
    {
        if (func_num_args() === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        foreach ($keys as $key) {
            if (!$this->offsetExists($key)) {
                return false;
            }
        }

        return true;
    }

    public function hasAny(...$keys): bool
    {
        if (func_num_args() === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        foreach ($keys as $key) {
            if ($this->offsetExists($key)) {
                return true;
            }
        }

        return false;
    }

    public function missing(...$keys): bool
    {
        return !$this->hasAny(...$keys);
    }

    public function missingAny(...$keys): bool
    {
        return !$this->has(...$keys);
    }
}
