Unit of WebPack
===

# Overview

 Multiple files are combined into one file and output.

# Usage

## Set the file path

```
//  Set the file path one by one.
Unit('WebPack')->Set('js', 'a.js');

//  Set the file path collectively.
Unit('WebPack')->Set('css', ['a.css','b.css']);
```

## Output the content from the registered file path

 Call from webpack directory. For example, `app/:webpack/index.php`.

```php
Unit('WebPack')->Out('css');
```

## For html.

```php
//  Get a hash of content. For browser cache.
$hash = Unit('WebPack')->FileContentHash('css');

//  Build URL.
$href = ConvertURL('app:/') . "webpack/css/?hash={$hash}";

//  Display for html.
echo '<link type="text/css" href="'.$href.'" rel="stylesheet">';
```
