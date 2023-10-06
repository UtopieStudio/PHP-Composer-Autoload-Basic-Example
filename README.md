# PHP Composer PSR-4 Autoload - Basic Example For Beginners.

#### TL;DR
Clone the repo and from root dir, run: 
`> composer install` to pull in the composer autoload files.
`> php public/index.php` to see the simple output from the autoloaded classes.

This may be enough for you to understand what's happening in regards to the `composer.json` settings, the `src` & `src/Invoice` dir naming, classes and their namespaces. 

### Detailed Instruction.
- VS Code users should install the extension `PHP Namespace Resolver` as this will auto-complete and add your namespaces as you work making your life much easier and save time.
- In your project root dir, run command `> composer init`
- When prompted tell composer your project details including your `organisationgname/projectname` and your PSR-4 autoloader dir; I used the suggested `src/`
    - Fill in or leave blank any other options Composer asks you as you see fit, the important ones are the aforementioned.

Your generated `composer.json` file should include the following block of json:

```json
    "autoload": {
        "psr-4": {
            "Utopiestudio\\Autoloaderbasicsetup\\": "src/"
        }
    },
```
You may wish to edit this after the fact, feel free, just make sure your namespace eg: `"Utopiestudio\\Autoloaderbasicsetup\\"` complies with the same formatting, uppercase camel-case letters and double backslashes.

In theory, this could be anything you want eg, `"SuperDuperLoader\\LoadingNow\\LovelyJubbly\\"`. Just stick to using letters, though. In affect, this portion of the instruction is just an alias for the directory portion to the right of it.

Speaking of which, make sure the `"src/"` dir portion is correct, too, i.e. it's a valid directory which exists and is where you will be storing your class files.

- You may also wish to create multiple namespaces declared in `composer.json` as a [ json ] array.

 > **IMPORTANT!**
 Whenever you make changes to your autoloader setting in the `composer.json` file, you must re-run the CLI command: 
 >`> composer du`
 >to inform composer of the changes and re-create the autoload files. 

### Wait, what if I already have composer setup in my project?
You can just edit your existing `composer.json` file with this autoload instruction, and then run the CLI command `> composer du` from your project root.

Your edited `composer.json` may look something like this:

```json
{
    "name": "utopiestudio/autoloaderbasicsetup",
    "description": "Very basic example of how to use the PSR-4 Autoloader in PHP with Composer package manager.",
    "type": "project",
    "autoload": {
        "psr-4": {
            "Utopiestudio\\Autoloaderbasicsetup\\": "src/"
        }
    },
    "require": {}
}
```
## Understanding how it works.
Look at the `src/SrcClass.php` file.
```php
namespace Utopiestudio\Autoloaderbasicsetup;

class SrcClass
{
    public function __construct()
    {
        echo "SrcClass, loaded!" . PHP_EOL;
    }
}
```
It's a simple class with an echo command.
- **Notice** how the class name and the file name are the same? This is important for autoloading to work. They're also capitalised, a standard practice for classes and namespaces.
- **Notice** at the top of the class file we declare the namespace this class will use: 
```php
namespace Utopiestudio\Autoloaderbasicsetup;
```
- **Notice** how this namespace is the same as the alias set in `composer.json` (without the double backslashes)? This is because the `SrcClass.php` file is stored **directly** in the `src/` directory.

## Now look at the `src/Invoice` folder
This is a theoretical project folder storing classes which deal with creating an invoice, though *you* may have folders like `Model`, `View`, `Controller` etc...

Look at the `src/Invoice/PdfClass.php` file.
```php
namespace Utopiestudio\Autoloaderbasicsetup\Invoice;

class PdfClass
{
    public function __construct()
    {
        echo "PdfClass extended class loaded!" . PHP_EOL;
    }
}
```
**Notice** how the namespace here has `\Invoice` appended, of course, this is because this file is stored in the `src/Invoice` folder and so we represent that in the namespace so our autoloader can find it.
**Notice** again how we capitalise the folder `Invoice` and reflect this in the the namespace.

## use (include) classes.
This is where in VS Code the aforementioned PHP Namespace Resolver extension comes in very hand indeed as it will detect your namespace setup and auto suggest and import classes for you.

Look at the class file `src/Invoice/EmailClass.php`:
```php
namespace Utopiestudio\Autoloaderbasicsetup\Invoice;

use Utopiestudio\Autoloaderbasicsetup\Invoice\PdfClass;

class EmailClass extends PdfClass
{
    public function __construct()
    {
        echo "EmailClass loaded!" . PHP_EOL;
        parent::__construct();
    }
}
```
This class will extend the PdfClass. So first, we declare a namespace for the class (as per the folder it lives in - which is again, `src/Invoice`), and then after, we 'include' the class it extents by using the `use` command to pull in `PdfClass`.

>**Note:** your classes may make use of other packages you have required in your project with composer (e.g. PHPMailer), and you can also reference a `use` statement for those package namespaces. 

## Finally...
Look at the `public/index.php` file.
```php
use Utopiestudio\Autoloaderbasicsetup\Invoice\EmailClass;
use Utopiestudio\Autoloaderbasicsetup\SrcClass;

// Include the composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

$obj = new SrcClass;
$obj2 = new EmailClass;
```

Here you can see it all come together. 

We `use` the classes SrcClass and EmailClass. You can easily see how the namespaces are different depending on the folder the files live.

Also notice how we don't need to reference the `use` namespace for the `PdfClass` here as we declared that in the `EmailClass`.

Next we must require we include the composer autoload file before we make instances of any classes.

Then we instantiate new objects with `$obj` and `$obj2`.

When you run this `index.php` file you will see the output from the classes proving they are correctly namespaced.

# ~fin.

