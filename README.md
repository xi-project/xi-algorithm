# Xi Algorithm

A collection of miscellaneous algorithms.

## Luhn

Usage:

```php
use Xi\Algorithm\Luhn;

$luhn = new Luhn();
$luhn->generate(123); // 1230
```

## Topological sort

Sorts the nodes of an acyclic graph so that if node X points to node Y then Y appears before X in the list. [Read more.](http://en.wikipedia.org/wiki/Topological_sorting)

Basically, it's useful for resolving a dependency graph.

Usage:

```php
// A description of a graph:
$edges = array(
    'B' => array('C', 'D'),   // Node B points to nodes C and D
    'A' => array('B'),        // Node A points to node B
    'C' => array('D'),        // Node C points to node D
);

$nodesSorted = \Xi\Algorithm\TopologicalSort::apply($edges);
// $nodesSorted is now array('D', 'C', 'B', 'A')
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
