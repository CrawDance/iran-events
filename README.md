## Iran Events And Holidays

A simple package to check Iran holidays and events using Jalali Calendar.

##  Installation 

You can install the package via composer:

```bash
composer require crawdance/iran-events
```


Add this line in your app.php file if your laravel version is below 5.6:

 ```sh
'providers' => [
  ...
    CrawDance\IranEvents\Providers\IranEventsServiceProvider::class,
  ...
 ];
```

## Usage:

```sh
return IranEvents::Check('1408-12-29');
```

The result is:

```sh
array:3 [▼
  "holiday" => true
  "type" => "تقویم خورشیدی"
  "desc" => "روز ملي شدن صنعت نفت ايران"
]
```

#### Hijri Events: 
```sh
return IranEvents::Check('1408-4-13');
```
```sh
array:3 [▼
  "holiday" => true
  "type" => "تقویم قمری"
  "desc" => "اربعين حسيني"
]
```

This package requires <a href="https://github.com/alkoumi/laravel-hijri-date">laravel-hijri-date</a> and <a href="https://github.com/briannesbitt/Carbon">Carbon</a> to convert Jalali inserted date to Ummul Qura Hijri and Gregorian.

## Issues

If you find a bug while using this package , please open an issue about the bug also affects ... and, unless it is obvious, the reason why you think the current result is wrong.

## License

The MIT License (MIT).


 
