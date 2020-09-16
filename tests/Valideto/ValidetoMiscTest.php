<?php


use Hashemi\Valideto\Valideto;
use PHPUnit\Framework\TestCase;

class ValidetoMiscTest extends TestCase
{
    public function testEmail()
    {
        $data = [
            'email' => 'rafsanhashemi@xyz.com'
        ];

        $validator = new Valideto($data, [
            'email' => ['email']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testEmailFailsMessage()
    {
        $data = [
            'email' => 'rafsanhashemi.com'
        ];

        $validator = new Valideto($data, [
            'email' => ['email']
        ]);

        $validator->validate();

        $this->assertSame([
            'email' => [
                'email' => 'This email is not valid email'
            ]
        ], $validator->getErrorMessages());
    }

    public function testUrl()
    {
        $data = [
            'website' => 'http://rafsan.com'
        ];

        $validator = new Valideto($data, [
            'website' => ['url']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testUrlFailsMessage()
    {
        $data = [
            'website' => 'rafsan.com'
        ];

        $validator = new Valideto($data, [
            'website' => ['url']
        ]);

        $validator->validate();

        $this->assertSame([
            'website' => [
                'url' => 'This website is not valid url'
            ]
        ], $validator->getErrorMessages());
    }

    public function testIpV4()
    {
        $data = [
            'ip' => '127.0.0.1'
        ];

        $validator = new Valideto($data, [
            'ip' => ['ip']
        ]);

        $this->assertSame($data, $validator->validate());
    }

    public function testIpV4FailsMessage()
    {
        $data = [
            'ip' => '127.227.257.222'
        ];

        $validator = new Valideto($data, [
            'ip' => ['ip']
        ]);

        $validator->validate();

        $this->assertSame([
            'ip' => [
                'ip' => 'This ip is not valid ip'
            ]
        ], $validator->getErrorMessages());
    }

    public function testCustomRule()
    {
        $data = [
            'name' => 'Hashemi Rafsan'
        ];

        $customRule = new MyCustomRule();

        $validator = new Valideto($data, [
            'name' => [$customRule]
        ]);


        $this->assertSame($data, $validator->validate());
    }

    public function testCustomRuleFailsMessage()
    {
        $data = [
            'name' => 'Rafsan Jani'
        ];

        $customRule = new MyCustomRule();

        $validator = new Valideto($data, [
            'name' => [$customRule]
        ]);

        $validator->validate();

        $this->assertSame([
            'name' => [
                $customRule->ruleName() => $customRule->message()
            ]
        ], $validator->getErrorMessages());
    }
}