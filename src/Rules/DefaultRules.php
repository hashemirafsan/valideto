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
        if (array_key_exists($key, $this->data)) {
            return !empty($this->data[$key]) && !is_null($this->data[$key]);
        }
        return false;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isNullable(string $key): bool
    {
        if (! array_key_exists($key, $this->data)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isArray(string $key, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_array($this->data[$key]);
        }

        return false;
    }

    public function isAssoc(string $key, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
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
     * @param null $data
     * @return bool
     */
    public function isString(string $key, bool $nullable = false, $data = null): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_string($data ?? $this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @param null $data
     * @return bool
     */
    public function isNumeric(string $key, bool $nullable = false, $data = null): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_numeric($data ?? $this->data[$key]);
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
        if ($nullable && $this->isNullable($key)) {
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
     * @param null $data
     * @return bool
     */
    public function isInteger(string $key, bool $nullable = false, $data = null): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return is_int($data ?? $this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @param null $data
     * @return bool
     */
    public function isFloat(string $key, bool $nullable = false, $data = null): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return is_float($data ?? $this->data[$key]);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @param null $data
     * @return bool
     */
    public function isBoolean(string $key, bool $nullable = false, $data = null): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return is_bool($data ?? $this->data[$key]);
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
        if ($nullable && $this->isNullable($key)) {
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
        if ($nullable && $this->isNullable($key)) {
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
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] <= $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $nullable
     * @return bool
     */
    public function isGt(string $key, $value, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] > $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $nullable
     * @return bool
     */
    public function isGte(string $key, $value, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] >= $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $nullable
     * @return bool
     */
    public function isLt(string $key, $value, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] < $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param $value
     * @param bool $nullable
     * @return bool
     */
    public function isLte(string $key, $value, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key) && $this->isNumeric($key)) {
            return $this->data[$key] <= $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param string $type
     * @param $value
     * @param bool $nullable
     * @return bool
     */
    public function isEq(string $key, string $type, $value, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($type === 'integer') {
            $value = (int) $value;
        }

        if ($type === 'float') {
            $value = (float) $value;
        }

        if ($type === 'string') {
            $value = (string) $value;
        }

        if ($type === 'boolean') {
            $value = (bool) $value;
        }


        if ($this->isString($key, $nullable, $value)) {
            return $this->data[$key] === (string) $value;
        }

        if ($this->isBoolean($key, $nullable, $value)) {
            return $this->data[$key] === (bool) $value;
        }
        if ($this->isInteger($key, $nullable, $value)) {
            return $this->data[$key] === (int) $value;
        }

        if ($this->isFloat($key, $nullable, $value)) {
            return $this->data[$key] === (float) $value;
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isEmail(string $key, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return (bool) filter_var($this->data[$key], FILTER_VALIDATE_EMAIL);
        }

        return false;
    }

    /**
     * @param string $key
     * @param string $type
     * @param bool $nullable
     * @return bool
     */
    public function isIp(string $key, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return (bool) filter_var($this->data[$key], FILTER_VALIDATE_IP);
        }

        return false;
    }

    /**
     * @param string $key
     * @param bool $nullable
     * @return bool
     */
    public function isUrl(string $key, bool $nullable = false): bool
    {
        if ($nullable && $this->isNullable($key)) {
            return true;
        }

        if ($this->isRequired($key)) {
            return (bool) filter_var($this->data[$key], FILTER_VALIDATE_URL);
        }

        return false;
    }
}