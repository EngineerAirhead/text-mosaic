# Text mosaic

### Turn any bit text into a colorful square PNG, just because you can!

---

### Installation

Simply require the composer package:
```
composer require engineer-airhead/text-mosaic
```

---

### Usage

#### Encoding
When encoding text to an image, you load the Encoder and provide the text you want to encode.
The encoder will return a base64 representation of the image that you can then use in your webpage;

```php
use EngineerAirhead\TextMosaic\Encoder;

$message = 'This is a nice example :D';

$encode = (new Encoder())->encode($message);

echo $message . '<br />';

echo '<img src="data:image/png;base64,' . $encode . '">';
```

Result:

```html
This is a nice example :D<br />
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAXElEQVQ4jWMMc8/4z4AGpGQE0YUYLvG+whAzv8SKIcaEIUIhGIEGsnxmOIsp+u0vhpAwiwaG2H210UihhYEskoK8GILMjJg55c35H5i62R9jCA1+Lw9+A0fBIAQAUrEOKavs7h0AAAAASUVORK5CYII=">
```

#### Decoding
Obviously, all images created with this library can also be decoded back to their textual representations!
Load the decoder and give it an image path, and it will return the textual version back to you.:

```php
use EngineerAirhead\TextMosaic\Decoder;

echo (new Decoder())->decode('img/example.png');
```

Result:

```text
This is a nice example :D
```