#Valideto
A simple PHP package for data validation with extensive preset rules and custom rules.

## Installation
You can start it from composer. Go to your terminal and run this command from your project root directory.

```php
composer require hashemi/valideto
```
## Usage
After Complete installation, It's time to check how to use *Valideto* easily.

```php
<?php

use Hashemi\Valideto\Valideto;

$data = [
    'first_name' => "Hashemi",
    'last_name'  => "Rafsan" ,
    'email' => 'rafsan@xyz.com'
];

$validator = new Valideto($data, [
   'first_name' => ['required', 'string'],
   'last_name'  => ['required', 'string'],
   'email' => ['required', 'email']
]);

// Call "validate" for validating your data
$validator->validate();

if ($validator->success()) {
    // do something...
}

if ($validator->fails()) {
    // do something if fails
}

```
You should be use that when you want to validate your data. *Valideto* expose many default rules for validation but if user need to make by own they can also do that.
Already there is option to change the default rules logic if you don't like to use. *Valideto* provide an interface for change default validation rules logic.


Then let's check how you can do that but *recommended* to not change it, Once if you change it's you will be liable to result

```php
<?php

use Hashemi\Valideto\Rules\DefaultRulesInterface;
use Hashemi\Valideto\Valideto;

class OwnRulesClass implements DefaultRulesInterface
{
    public function setData(array $data): self {}
    public function isRequired(string $key): bool {}
    public function isNullable(string $key): bool {}
    public function isArray(string $key, bool $nullable = false): bool {}
    public function isAssoc(string $key, bool $nullable = false): bool {}
    public function isString(string $key, bool $nullable = false): bool {}
    public function isNumeric(string $key, bool $nullable = false): bool {}
    public function isDistinct(string $key, bool $nullable = false): bool {}
    public function isInteger(string $key, bool $nullable = false): bool {}
    public function isFloat(string $key, bool $nullable = false): bool {}
    public function isBoolean(string $key, bool $nullable = false): bool {}
    public function isSize(string $key, int $length, bool $nullable = false): bool {}
    public function isMax(string $key, int $value, bool $nullable = false): bool {}
    public function isMin(string $key, int $value, bool $nullable = false): bool {}
}

$data = [
    'first_name' => "Hashemi",
    'last_name'  => "Rafsan" ,
    'email' => 'rafsan@xyz.com'
];

$validator = new Valideto($data, [
   'first_name' => ['required', 'string'],
   'last_name'  => ['required', 'string'],
   'email' => ['required', 'email']
]);

// Call "validate" for validating your data
$validator->setRulesClass(new OwnRulesClass());

$validator->validate();
```
Do it, your own risk :D 

## List of Default Rules:

* [required](required)
* [max](max)
* [min](min)
* [gt](gt)
* [gte](gte)
* [lt](lt)
* [lte](lte)
* [eq](eq)
* [nullable](nullable)
* [distinct](distinct)
* [date](date)
* [date_format](date_format)
* [array](array)
* [url](url)
* [ip](ip)
* [boolean](boolean)
* [email](email)
* [string](string)
* [digits](digits)
* [size](size)
* [numeric](numeric)
* [integer](integer)
* [float](float)
* [assoc](assoc)

### `required`

**required** should be use for when you expect that value in your data

Example:
```php
$validator = new Valideto($data, [
   'first_name' => ['required'],
]);
```

### `max`

**max** should be use for when you need to check if value exceed max value or not

Example:
```php
$validator = new Valideto($data, [
   'age' => ['max:24'],
]);
```

### `min`

**min** should be use for when you need to check if value have at least minimum value or not

Example:
```php
$validator = new Valideto($data, [
   'age' => ['min:24'],
]);
```

### `gt`

**gt** should be use for when you need to check if value greater than or not

Example:
```php
$validator = new Valideto($data, [
   'age' => ['gt:24'],
]);
```

### `gte`

**gte** should be use for when you need to check if value greater than or equal

Example:
```php
$validator = new Valideto($data, [
   'age' => ['gte:24'],
]);
```

### `lt`

**lt** should be use for when you need to check if value less than or not

Example:
```php
$validator = new Valideto($data, [
   'age' => ['lt:24'],
]);
```

### `lte`

**lte** should be use for when you need to check if value less than or equal

Example:
```php
$validator = new Valideto($data, [
   'age' => ['lte:24'],
]);
```

### `eq`

**eq** should be use for when you need to check if value equal

Example:
```php
$validator = new Valideto($data, [
   'age' => ['eq:integer|float|string|boolean:24'],
]);
```

### `nullable`

**nullable** should be use for when value is not required

Example:
```php
$validator = new Valideto($data, [
   'age' => ['nullable'],
]);
```

### `distinct`

**distinct** should be use for when you don't duplicate value in array

Example:
```php
$validator = new Valideto($data, [
   'hobbies' => ['array', 'distinct'],
]);
```

### `date`

**date** should be use for when you check date is valid or not

Example:
```php
$validator = new Valideto($data, [
   'start_date' => ['date'],
]);
```

### `date_format`

**date_format** should be use for when you check date format is valid or not

Example:
```php
$validator = new Valideto($data, [
   'start_date' => ['date_format:Y-m-d'],
]);
```

### `array`

**array** should be use for when you check the data is array or not

Example:
```php
$validator = new Valideto($data, [
   'start_date' => ['date_format:Y-m-d'],
]);
```

### `url`

**url** should be use for when you check the data is url or not

Example:
```php
$validator = new Valideto($data, [
   'website' => ['url'],
]);
```

### `ip`

**ip** should be use for when you check the data is ip or not

Example:
```php
$validator = new Valideto($data, [
   'ip' => ['ip'],
]);
```

### `boolean`

**boolean** should be use for when you check the data is boolean or not

Example:
```php
$validator = new Valideto($data, [
   'is_enable' => ['boolean'],
]);
```

### `email`

**email** should be use for when you check the data is email or not

Example:
```php
$validator = new Valideto($data, [
   'email' => ['email'],
]);
```

### `string`

**string** should be use for when you check the data is string or not

Example:
```php
$validator = new Valideto($data, [
   'first_name' => ['string'],
]);
```

### `numeric`

**numeric** should be use for when you check the data is numeric or not

Example:
```php
$validator = new Valideto($data, [
   'id' => ['numeric'],
]);
```

### `integer`

**integer** should be use for when you check the data is integer or not

Example:
```php
$validator = new Valideto($data, [
   'id' => ['integer'],
]);
```

### `float`

**float** should be use for when you check the data is float or not

Example:
```php
$validator = new Valideto($data, [
   'price' => ['float'],
]);
```

### `assoc`

**assoc** should be use for when you check the data is associative array or not

Example:
```php
$validator = new Valideto($data, [
   'hobbies' => ['array', 'assoc'],
]);
```

## Contributing
Pull requests are welcome. For any changes, please open an issue first to discuss what you would like to change.