<?php

use Hashemi\Valideto\Valideto;
use PHPUnit\Framework\TestCase;

class ValidetoEngineTest extends TestCase
{
    public function testValidatedData()
    {
        $data = [
            'first_name' => 'Hashemi',
            'last_name' => 'Rafsan',
            'age' => 24,
            'experience' => 1.2,
            'hobbies' => [
                'cricket',
                'programming'
            ]
        ];

        $validator = new Valideto($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'numeric', 'integer'],
            'experience' => ['required', 'numeric', 'float'],
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

    public function testNullable()
    {
        $data = [];

        $validator = new Valideto($data, [
            'first_name' => ['nullable']
        ]);

        $validator->validate();

        self::assertSame($data, $validator->validate());
    }
}
