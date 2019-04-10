# PMG Support

Some small utilities we use in our applications.

## `PMG\Support\Types`

### Get the Type of an Input

```php
use PMG\Support\Types;

var_dump(Types::of(new stdClass)); // 'stdClass'
var_dump(Types::of('test')); // 'string'
```

### Get a String Representation of an Object

```php
use PMG\Support\Types;

echo Types::repr(new stdClass), PHP_EOL; // object(stdClass)
echo Types::repr(['one']), PHP_EOL; // array(["one"])
echo Types::repr('test'), PHP_EOL; // test
```

## `PMG\Support\Json`

The main benefit here is that the `Json` class checks the return values and
errors if the underlying `json_{encode,decode}` failed.

```php
use PMG\Support\Json;

echo Json::encode(['one']), PHP_EOL;

$array = Json::decode('["one"]');
var_dump($array);
```

## `PMG\Support\Ids`

We tend to use value objects to represent identifiers, these all implement
`PMG\Support\Id`. By default that's a `PMG\Support\Ids\Uuid`.

### Working with UUIDs

```php
use PMG\Support\Ids;

// generate a new UUID
$newId = Ids::generate();

// convert a string into a UUID
$uuid = Ids::from('1295bf14-c1aa-43a0-8ad2-3985b4e552d2');

// or "ensure" a value is an `Id`

// if given an `Id`, then that object is return
$otherUuid = Ids::ensure($uuid); 
var_dump($otherUuid === $uuid); // true

// if given a string, it will attemp to convert it to a UUID
$uuid = Ids::ensure('1295bf14-c1aa-43a0-8ad2-3985b4e552d2');

// or a `PMG\Support\Ids\InvalidId` exception will be thrown for any other type
Ids::ensure(123); // error

// both `from` and `ensure will throw InvalidId with an invalid UUID format
Ids:from('nope'); // throws
Ids::ensure('nope'); // throws
```

### `PMG\Support\HasId`

This interface is to *mark* an object as having an identifer. A trait is
provided that implements this interface.

```php
use PMG\Support\HasId;
use PMG\Support\Id;
use PMG\Support\Ids;
use PMG\Support\ImplementHasId;

class WithAnId implements HasId
{
    use ImplementsHasId;

    public function __construct(?Id $id)
    {
        // setIdentifier is a protected method from ImplementHasId
        $this->setIdentifier($id);
    }
}

// passing `null` to `setIdentifier` (via the constructor here) will
// generate a new UUID
$generated = new WithAnId(null);
var_dump($generated->getIdentifier()); // a `PMG\Support\Ids\Uuid` object is returned

// otherwise the ID object passed to the constructor will be returned
$id = Ids::generate();
$passed = new WithAnId($id);
$id === $passed->getIdentifier(); // true
```

### Working with IDs in Tests

Use `PMG\Support\Ids\StubId` or `PMG\Support\Ids\NullId`. Both can be generated
from `Ids`.

```php
use PMG\Support\Ids;

$stub = Ids::stub('testMe');

$none = Ids::none();
```

## `PMG\Support\Clock`

This abstraction is used to avoid doing `new DateTimeImmutable` everywhere as we
want to be able to control that creation (for testing purposes and otherwise to
control things like timezone more explicitly).

There are two implementations here:

- `PMG\Support\Clock\TzAwareClock` -- returns dates with the timezone given in
  its constructor.
- `PMG\Support\Clock\StubClick` -- always returns the date given in the
  constructor. This is useful for testing.

### The Default Clock

The default clock, retrieved with `Clock::get`, is a `TzAwareClock` with a UTC
timezone.

```php
use PMG\Support\Clock;

/** @var $clock PMG\Support\Clock\TzAwareClock */
$clock = Clock::get();
```

### Main API

```php
// $clock from above

$now = $clock->now(); // current time, no microseconds

$date = $clock->from('2019-01-01'); // date time object from a date string

// TzAwareClock will do one of three things, each one sets the timezone to
// the DateTimeZone given in its constructor

// 1. convert a `DateTime` to `DateTimeImmutable`
$immutable = $clock->ensure(new DateTime('2019-01-01'));
var_dump($immutable); // DateTimeImmutable object

// 2. ensure that the timezone is set on immutable date time
$other = $clock->ensure(new DateTimeImmutable('2019-01-01'));
var_dump($other->getTimeZone()); // UTC (or whatever was passed in)

// 3. convert from a string
$date = $clock->ensure('2019-01-01'); 

Any other value will throw `PMG\Support\Exception\InvalidArgumentException
$clock->ensure(123); // not a string or datetime object, throws
```

### Testing

Use `PMG\Support\Clock\StubClock`, which will always return a clone of the
`DateTimeImmutable` given in its constructor.

```php
use PMG\Support\Clock\StubClock;

$date = new DateTimeImmutable('2019-01-01');
$clock = new StubClock($date);

$date == $clock->now(); // true
$date === $clock->now(); // false, StubClock returns a clone

$date == $clock->from('ThisIsIgnored'); // true

$date == $clock->ensure(new DateTime('2019-02-01')); // true, the value passed is ignored
```
