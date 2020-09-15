<?php

declare(strict_types=1);

namespace Hashemi\Valideto\Engine;

use Hashemi\Valideto\Rules\DefaultRulesInterface;

abstract class ValidetoEngine
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $errorMessages = [];

    /**
     * @var null
     */
    private $rulesClass = null;

    /**
     * @var array
     */
    protected $messages = [
        'required' => 'This :attribute is required',
        'max' => 'This :attribute exceed max value',
        'array' => 'This :attribute should be array',
        'size' => 'This :attribute length should be :value',
        'distinct' => 'This :attribute has duplicate value',
        'string' => 'This :attribute should be string'
    ];

    public function setRulesClass(DefaultRulesInterface $rulesClass): ValidetoEngine
    {
        $this->rulesClass = $rulesClass->setData($this->getData());
        return $this;
    }

    /**
     * @return null
     */
    public function getRulesClass()
    {
        return $this->rulesClass;
    }

    abstract public function setData(array $data): self;
    abstract public function getData(): array;
    abstract public function setRules(array $rules): self;
    abstract public function getRules(): array;
    abstract public function setMessages(array $messages): self;

    /**
     * @param string|null $key
     * @return array|mixed|string|string[]
     */
    public function getMessages(string $key = null)
    {
        return $this->messages[$key] ?? $this->messages;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    /**
     * @return array
     */
    public function validate(): array
    {
        $data = [];
        $isValidated = true;
        foreach ($this->getRules() as $key => $rules) {
            if ($isValidated &= $this->isValidateByRules($key, $rules)) {
                $data[$key] = $this->data[$key];
            }
        }

        return $isValidated ? $data : [];
    }

    /**
     * @param string $key
     * @param array $rules
     * @return bool
     */
    protected function isValidateByRules(string $key, array $rules): bool
    {
        $isValid = true;
        foreach($rules as $rule) {
            $rule = explode(':', $rule);
            $method = sprintf("is%s", ucfirst($rule[0]));
            $param = [$key];

            if (count($rule) > 1) {
                $param[] = $rule[1];
            }

            if (! call_user_func_array([$this->getRulesClass(), $method], $param)) {
                $this->errorMessages[$key][$rule[0]] = preg_replace('/:attribute/i',$key,$this->getMessages($rule[0]));

                if (count($param) > 1) {
                    $this->errorMessages[$key][$rule[0]] = preg_replace('/:value/i', $param[1], $this->errorMessages[$key][$rule[0]]);
                }
            }
        }
        return $isValid;
    }

    /**
     * @return bool
     */
    public function success(): bool
    {
        return (bool) count($this->getErrorMessages());
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return count($this->getErrorMessages()) > 0;
    }
}