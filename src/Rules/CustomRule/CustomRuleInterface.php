<?php


namespace Hashemi\Valideto\Rules\CustomRule;

/**
 * Interface CustomRuleInterface
 * @package Hashemi\Valideto\Rules\CustomRule
 */
interface CustomRuleInterface
{
    public function ruleName(): string;
    public function process($value, bool $isNullable): bool;
    public function message(): string;
}