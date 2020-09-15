<?php


namespace Hashemi\Valideto\Rules;


interface DefaultRulesInterface
{
    public function setData(array $data): self;
    public function isRequired(string $key): bool;
    public function isArray(string $key): bool;
    public function isString(string $key): bool;
    public function isNumeric(string $key): bool;
    public function isDistinct(string $key): bool;
    public function isInteger(string $key): bool;
    public function isFloat(string $key): bool;
    public function isBoolean(string $key): bool;
    public function isSize(string $key, int $length): bool;
    public function isMax(string $key, int $value): bool;
    public function isMin(string $key, int $value): bool;
}