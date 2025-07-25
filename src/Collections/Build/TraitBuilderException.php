<?php

declare(strict_types=1);

namespace AppUtils\Collections\Build;

use AppUtils\Collections\CollectionException;

class TraitBuilderException extends CollectionException
{
    public const ERROR_CANNOT_READ_TEMPLATE_FILE = 179001;
    public const ERROR_CANNOT_WRITE_TRAIT_FILE = 179002;
}
