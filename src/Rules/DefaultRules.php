<?php

declare(strict_types=1);

namespace Hashemi\Valideto\Rules;

/**
 * Class DefaultRules
 * @package Hashemi\Valideto\Rules
 */
class DefaultRules implements DefaultRulesInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string[]
     */
    protected $presets = [
        'required',
        'max',
        'min',
        'gt',
        'gte',
        'lt',
        'lte',
        'nullable',
        'distinct',
        'date',
        'array',
        'url',
        'boolean',
        'date_format',
        'email',
        'string',
        'digits',
        'size',
        'numeric',
        'integer',
        'float',
        'assoc',
    ];

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isRequired(string $key): bool
    {
        if (isset($this->data[$key])) {
            return !empty($this->data[$key]) && ! is_null($this->data[$key]);
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isNullable(string $key): bool
    {
        return true;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isArray(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_array($this->data[$key]);
        }

        return false;
    }

    public function isAssoc(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isArray($key)) {
            return array_values($this->data[$key]) !== $this->data[$key];
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isString(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_string($this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isNumeric(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_numeric($this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isDistinct(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isArray($key)) {
            return count($this->data[$key]) === count(array_flip($this->data[$key]));
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isInteger(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return is_int($this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isFloat(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return is_float($this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isBoolean(string $key, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_bool($this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param int $length
     * @param bool $nullable
     * @return bool
     */
    public function isSize(string $key, int $length, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isArray($key)) {
            return count($this->data[$key]) === $length;
        }

        return false;
    }

    /**
     * @param string $key
     * @param int $value
     * @param bool $nullable
     * @return bool
     */
    public function isMax(string $key, int $value, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] >= $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param int $value
     * @param bool $nullable
     * @return bool
     */
    public function isMin(string $key, int $value, bool $nullable = false): bool
    {
        if ($nullable && ! $this->isRequired($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] <= $value;
        }

        return false;
    }
}