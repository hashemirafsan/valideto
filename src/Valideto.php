<?php

declare(strict_types=1);

namespace Hashemi\Valideto;

use Hashemi\Valideto\Engine\ValidetoEngine;
use Hashemi\Valideto\Rules\DefaultRules;
use Hashemi\Valideto\Rules\DefaultRulesInterface;

class Valideto extends ValidetoEngine
{

    /**
     * Valideto constructor.
     * @param array $data
     * @param array $rules
     * @param array $message
     * @param DefaultRulesInterface|null $defaultRulesClass
     */
    public function __construct(array $data, array $rules, array $message = [], DefaultRulesInterface $defaultRulesClass = null)
    {
        $this->setData($data);
        $this->setRules($rules);
        $this->setMessages($message);
        $this->setRulesClass($defaultRulesClass ?? (new DefaultRules()));
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules): self
    {
        $this->rules = array_merge($this->rules, $rules);
        return $this;
    }

    /**
     * @param array $message
     * @return $this
     */
    public function setMessages(array $message): self
    {
        $this->messages = array_merge($this->messages, $message);
        return $this;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

}