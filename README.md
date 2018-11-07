# unique-id

This library implements uuid and object id(like mongodb object id).


[![Latest Version](https://img.shields.io/packagist/v/collin-peng/unique-id.svg?style=flat-square)](https://packagist.org/packages/collin-peng/unique-id)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)


## Install

Install with [composer](https://getcomposer.org/).

```bash
composer require collin-peng/unique-id
```

## Usage

```php
use CollinPeng\UniqueId;

$uniqueId = new UniqueId();

// generate object id
$uniqueId->objectId();


// generate uuid
$uniqueId->uuid()
```


## Testing

You can use the following command to test：

```bash
make test
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.