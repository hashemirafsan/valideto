<?php


use Hashemi\Valideto\Valideto;
use PHPUnit\Framework\TestCase;

class ValidetoStringTest extends TestCase
{
    public function testString()
    {
        $data = [
            'first_name' => 'string'
        ];

        $validator = new Valideto($data, [
            'first_name' => ['string']
        ]);

        self::assertSame($data, $validator->validate());
    }

    public function testStringFailedMessage()
    {
        $data = [
            'first_name' => null
        ];

        $validator = new Valideto($data, [
            'first_name' => ['string']
        ]);

        $validator->validate();

        self::assertSame([
            'first_name' => [
                'string' => 'This first_name should be string'
            ]
        ], $validator->getErrorMessages());
    }

    public function testStringWithNullable()
    {
        $data = [
            'first_name' => 'Hashemi Rafsan'
        ];

        $validator = new Valideto($data, [
            'first_name' => ['nullable', 'string']
        ]);

        $validator->validate();

        self::assertSame($data, $validator->validate());
    }

    public function testStringWithNullableFailsMessage()
    {
        $data = [
            'first_name' => null
        ];

        $validator = new Valideto($data, [
            'first_name' => ['nullable', 'string']
        ]);

        $validator->validate();

        self::assertSame([
            'first_name' => [
                'string' => 'This first_name should be string'
            ]
        ], $validator->getErrorMessages());
    }
}