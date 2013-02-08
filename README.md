# Xi Algorithm

## Luhn

Usage:

```
use Xi\Algorithm\Luhn;

$luhn = new Luhn();
$luhn->generate(123); // 1230
```

## Running the tests

No dependencies to other libraries exist, but in order to generate an autoloader
first run

```
composer.phar install --dev
```

and then run the tests with

```
phpunit -c tests
```
