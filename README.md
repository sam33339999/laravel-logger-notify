## Line Notify For Laravel Logger Channel


```php
# config/logging.php
[
    'channels' => [
        'custom' => [
            'driver' => 'custom',
            'via' => SaC\LoggerLineNotify\Logging\Main::class,        
        ]
    ]
]
```