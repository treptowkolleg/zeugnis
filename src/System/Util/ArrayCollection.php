<?php

namespace App\System\Util;

class ArrayCollection implements \IteratorAggregate, \Countable
{

    private array $elements = [];

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(mixed $element): void
    {
        $this->elements[] = $element;
    }

    public function remove(mixed $element): bool
    {
        $key = array_search($element, $this->elements, true);
        if ($key !== false) {
            unset($this->elements[$key]);
            $this->elements = array_values($this->elements);
            return true;
        }
        return false;
    }

    public function contains(mixed $element): bool
    {
        return in_array($element, $this->elements, true);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function get(int $index): mixed
    {
        return $this->elements[$index] ?? null;
    }

    public function set(int $index, mixed $element): void
    {
        $this->elements[$index] = $element;
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    public function filter(callable $predicate): self
    {
        return new self(array_filter($this->elements, $predicate));
    }

    public function map(callable $func): self
    {
        return new self(array_map($func, $this->elements));
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->elements);
    }

    public function count(): int
    {
        return count($this->elements);
    }

}