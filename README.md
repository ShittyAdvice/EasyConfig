# EasyConfig

## Sample Usage

### Loading an array
```php
use EasyConfig\EasyConfig;

$array = [
	'db' => [
		'host' => '127.0.0.1'
	]
];

$config = new EasyConfig();
$config->load($array);
```

### Loading a file
```php
use EasyConfig\EasyConfig;
use EasyConfig\ConfigType;

$config = new EasyConfig();
$config->load('config.php', ConfigType::File);
```

### Loading a json string
```php
use EasyConfig\EasyConfig;
use EasyConfig\ConfigType;

$json = '{"db": { "host": "127.0.0.1" }}';

$config = new EasyConfig();
$config->load($json, ConfigType::Json);
```

### Retrieving values
The get function in EasyConfig allows for 2 parameters.
The first parameter represents the key to retrieve the value from. Multidimensional arrays can be accessed with the dot ('.') seperator.

The second parameter represents a default value in case the config key isn't found.
This parameter is optional and is null by default
```php
use EasyConfig\EasyConfig;

$array = [
	'db' => [
		'host' => '8.8.8.8'
	]
];

$config = new EasyConfig();
$config->load($array);


echo $config->get('db.host');
//Output: 8.8.8.8

echo $config->get('db.host', '127.0.0.1');
//Output: 8.8.8.8

echo $config->get('database.host', '127.0.0.1');
//Output: 127.0.0.1
```
