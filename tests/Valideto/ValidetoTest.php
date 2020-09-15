<?php

use Hashemi\Valideto\Valideto;
use PHPUnit\Framework\TestCase;

class ValidetoTest extends TestCase
{
    public function testValidatedData()
    {
        $data = [
            'first_name' => 'Hashemi',
            'last_name' => 'Rafsan',
            'age' => 24,
            'hobbies' => [
                'cricket',
                'programming'
            ]
        ];

        $validator = new Valideto($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'numeric'],
            'hobbies' => ['array']
        ]);

        self::assertSame($data, $validator->validate());
    }

    public function testIsFailed()
    {
        $data = [
            'first_name' => null
        ];

        $validator = new Valideto($data, [
            'first_name' => ['required']
        ]);

        $validator->validate();

        self::assertTrue(true, $validator->fails());
    }

    public function testRequired()
    {
        $data = [
            'first_name' => 'Hashemi'
        ];

        $validator = new Valideto($data, [
            'first_name' => ['required']
        ]);

        self::assertSame($data, $validator->validate());
    }

    public function testRequiredFailsMessage()
    {
        $data = [
            'first_name' => null
        ];

        $validator = new Valideto($data, [
            'first_name' => ['required']
        ]);

        $validator->validate();

        self::assertSame([
            'first_name' => [
                'required' => 'This first_name is required'
            ]
        ], $validator->getErrorMessages());
    }

    public function testArray()
    {
        $data = [
            'hobbies' => [
                'cricket',
                'badminton',
                'programming'
            ]
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['array']
        ]);

        self::assertSame($data, $validator->validate());
    }

    public function testArrayFailedMessage()
    {
        $data = [
            'hobbies' => null
        ];

        $validator = new Valideto($data, [
            'hobbies' => ['array']
        ]);

        $validator->validate();

        self::assertSame([
            'hobbies' => [
                'array' => 'This hobbies should be array'
            ]
        ], $validator->getErrorMessages());
    }

    public function testString()
    {
        $data = [
            'first_name' => ['string']
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

}