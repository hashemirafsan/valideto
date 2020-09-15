<?php


namespace Hashemi\Valideto\Rules;


class DefaultRules implements DefaultRulesInterface
{
    protected $data = [];

    protected $presets = [
        'required',
        'max',
        'min',
        'gte',
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
        return isset($this->data[$key]) ? !empty($this->data[$key]) : false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isArray(string $key): bool
    {
        if ($this->isRequired($key)) {
            return is_array($this->data[$key]);
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isString(string $key): bool
    {
        if ($this->isRequired($key)) {
            return is_string($this->data[$key]);
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isNumeric(string $key): bool
    {
        if ($this->isRequired($key)) {
            return is_numeric($this->data[$key]);
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isDistinct(string $key): bool
    {
        if ($this->isRequired($key) && $this->isArray($key)) {
            return count($this->data[$key]) === count(array_flip($this->data[$key]));
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isInteger(string $key): bool
    {
        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return is_int($this->data[$key]);
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isFloat(string $key): bool
    {
        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return is_float($this->data[$key]);
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isBoolean(string $key): bool
    {
        if ($this->isRequired($key)) {
            return is_bool($this->data[$key]);
        }
    }

    /**
     * @param string $key
     * @param int $length
     * @return bool
     */
    public function isSize(string $key, int $length): bool
    {
        if ($this->isRequired($key) && $this->isArray($key)) {
            return count($this->data[$key]) === $length;
        }
        return false;
    }

    /**
     * @param string $key
     * @param int $value
     * @return bool
     */
    public function isMax(string $key, int $value): bool
    {
        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] >= $value;
        }
        return false;
    }

    /**
     * @param string $key
     * @param int $value
     * @return bool
     */
    public function isMin(string $key, int $value): bool
    {
        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] <= $value;
        }
        return false;
    }
}