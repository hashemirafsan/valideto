<?php


use Hashemi\Valideto\Rules\CustomRule\CustomRuleInterface;

class MyCustomRule implements CustomRuleInterface
{

    public function ruleName(): string
    {
        return 'my_custom_rule';
    }

    public function process($value, bool $isNullable): bool
    {
        return $value === "Hashemi Rafsan";
    }

    public function message(): string
    {
        return 'My rule is checking';
    }
}