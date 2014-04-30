# Composite

A composer package that wraps the [Composite](http://www.imagemagick.org/script/composite.php) command. Composite is part of the image editing software [ImageMagick](http://www.imagemagick.org/index.php).

## Usage

```

use Composite\Composite;

$composite = new Composite('base.png','overlay.png','result.png');
$composite->execute();

$resultFile = $composite.getResultFile();
$resultFile = $composite.getResultFile(true); //calls execute() before retrieving file

```

It also can take a fourth parameter to set command options

```
$composite = new Composite('base.png','overlay.png','result.png',array(
	'gravity'=>'southeast',
	'size'=>'512x512'
));

```

## License

MIT 