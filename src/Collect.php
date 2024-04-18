<?php

namespace Collect;

class Collect
{
    private array $array = [];

    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    //возвращает элемент массива с ключом, если он существует, иначе возвращает весь массив
    public function get($key = null)
    {
        return $this->array[$key] ?? $this->array;
    }

    //возвращает первый элемент массива
    public function first()
    {
        return $this->array[array_key_first($this->array)];
    }

    //возвращает количество элементов в массиве
    public function count(): int
    {
        return count($this->array);
    }

    //возвращает весь массив
    public function toArray(): array
    {
        return $this->array;
    }

    //применяет функцию $callback к каждому элементу массива и возвращает новый объект collect с преобразованными элементами
    public function map(callable $callback): Collect
    {
        return new self(array_map($callback, $this->array));
    }

    //применяет функцию $callback ко всем элементам массива с дополнительными аргументами $args
    public function each(callable $callback, ...$args): Collect
    {
        foreach ($this->array as $key => $item) {
            $callback($item, $key, ...$args);
        }
        return $this;
    }

    //добавляет новый элемент в конец массива
    public function push($value, $key = null): Collect
    {
        if (gettype($value) === 'array') {
            $value = new self($value);
        }
        if ($key) {
            $this->array[$key] = $value;
        } else {
            $this->array[] = $value;
        }
        return $this;
    }

    //добавляет новый элемент в начало массива
    public function unshift($value): Collect
    {
        array_unshift($this->array, $value);
        return $this;
    }
    //удаляет первый элемент массива
    public function shift(): Collect
    {
        array_shift($this->array);
        return $this;
    }
    //удаляет последний элемент массива
    public function pop(): Collect
    {
        array_pop($this->array);
        return $this;
    }
    //срезает элементы массива, начиная с индекса
    public function splice($idx, $length = 1): Collect
    {
        array_splice($idx, $length);
        return $this;
    }

    //фильтрует элементы массива
    public function filter(callable $callback): Collect
    {
        return new self(array_filter($this->array, $callback));
    }

    //проверяет, пуст ли массив
    public function isEmpty(): bool
    {
        return empty($this->array);
    }

    //проверяет, существует ли элемент с указанным ключом в массиве
    public function has($key): bool
    {
        return isset($this->array[$key]);
    }

    //меняет ключи и значения местами
    public function flip(): Collect
    {
        return new self(array_flip($this->array));
    }

    //объединяет текущий массив с другим массивом
    public function merge(array $array): Collect
    {
        return new self(array_merge($this->array, $array));
    }

    //возвращает массив состоящий из ключей полученного массива
    public function keys(): Collect
    {
        return new self(array_keys($this->array));
    }

}