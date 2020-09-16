<?php


namespace Hashemi\Valideto\Rules\CustomRule;

/**
 * Interface CustomRuleInterface
 * @package Hashemi\Valideto\Rules\CustomRule
 */
interface CustomRuleInterface
{
    public function ruleName(): string;
    public function process($value): bool;
    public function message(): string;
}