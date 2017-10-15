# Fluent Chaining for Legacy code
Are you tired of using packages that require you to write code like the following:
```php
$someClass = new SomeClass();
$someClass->someMethod();
$someClass->someOtherMethod();

// Now you can just write it like this.
new Chain(SomeClass::class)
    ->someMethod()
    ->someOtherMethod();
    
// Or even easier
ch(SomeClass::class)
    ->someMethod()
    ->someOtherMethod();
```


## Installation

Require the package from Composer:

``` bash
composer require thejawker/chainable
```

## Usage

### Basic Usage
You can use the Chain in two easy different ways, depending on your liking or necessity.

```php
// Through passing the Class's classname.
$someClass = new Chain(SomeClass::class);

// Or through passing the actual instance
$someClass = new Chain(new SomeClass($withParams))
```

### Getting Properties
Getting properties is just the same, these won't return `$this`.
```php
$property = new Chain(SomeClass::class)->property;
```

### Escaping Chaining
Often methods do need to return an actual value, otherwise we can stop programming all together.
Chain will allow you to easily turn off the chaining behaviour. This can be done very easily.
```php
$someClass = new Chain(SomeClass::class)->someMethod()
$property = $someClass->escape()->getValue() // will return the original value
``` 

You can also unescape to get the Chainable functionality back. To be honest I can't find a use case for this yet, but hey! You never know!
```php
$someClass = new Chain(SomeClass::class)->someMethod();
$sameInstance = $someClass->escape();
$sameInstance->unescape()->otherMethod();
```

### Get The Original Instance
Sometimes it is needed to return the original instance because some code might be checking if it is an `instanceof` a class.
You can easily chain the `->instance()` method on there and you get the original instance back, not a clone, the actual thing. 
Note: you can't go back from here.
```php
public function calculate() 
{
    return new Chain(new LegacyClass)
        ->someMethod()
        ->setSome('stuff')
        ->maybeMore()
        ->instance();
}
```

### Wanna Go Pro? 
I've also included a convenient shortcut for those who think instantiating a `Chain` is too much work. The following will yield exactly the same result but then just with much more ease.
```php
ch(LegacyClass::class)
    ->also()
    ->works('yay!')
    ->fuckYess();
```

## Testing

I've included some tests, feel free to send me pull-requests if you see room for improvement.
``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
