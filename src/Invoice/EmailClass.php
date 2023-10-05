<?php

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