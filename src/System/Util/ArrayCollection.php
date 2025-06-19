<?php
/*
 * Copyright (c) 2025 - Benjamin Wagner.
 * MIT License: https://opensource.org/licenses/MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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