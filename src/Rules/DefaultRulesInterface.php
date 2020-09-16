<?php


namespace Hashemi\Valideto\Rules;

/**
 * Interface DefaultRulesInterface
 * @package Hashemi\Valideto\Rules
 */
interface DefaultRulesInterface
{
    public function setData(array $data): self;
    public function isRequired(string $key): bool;
    public function isNullable(string $key): bool;
    public function isArray(string $key, bool $nullable = false): bool;
    public function isAssoc(string $key, bool $nullable = false): bool;
    public function isString(string $key, bool $nullable = false): bool;
    public function isNumeric(string $key, bool $nullable = false): bool;
    public function isDistinct(string $key, bool $nullable = false): bool;
    public function isInteger(string $key, bool $nullable = false): bool;
    public function isFloat(string $key, bool $nullable = false): bool;
    public function isBoolean(string $key, bool $nullable = false): bool;
    public function isSize(string $key, int $length, bool $nullable = false): bool;
    public function isMax(string $key, int $value, bool $nullable = false): bool;
    public function isMin(string $key, int $value, bool $nullable = false): bool;
}