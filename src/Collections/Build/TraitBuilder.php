<?php

declare(strict_types=1);

namespace AppUtils\Collections\Build;

class TraitBuilder
{
    public const VAR_COLLECTION_PREFIX = 'COLLECTION_PREFIX';
    public const VAR_DATA_TYPE = 'DATA_TYPE';
    public const VAR_SORT_STATEMENT = 'SORT_STATEMENT';
    public const VAR_PHP_DATA_TYPE = 'PHP_DATA_TYPE';
    public const VAR_TYPE_ARTICLE = 'TYPE_ARTICLE';
    public const VAR_GENERATION_DATE = 'GENERATION_DATE';

    private const DATA_TYPES = array(
        array(
            self::VAR_DATA_TYPE => 'string',
            self::VAR_PHP_DATA_TYPE => 'string',
            self::VAR_TYPE_ARTICLE => 'a',
            self::VAR_COLLECTION_PREFIX => 'StringPrimary',
            self::VAR_SORT_STATEMENT => 'strnatcasecmp($a->getID(), $b->getID())'
        ),
        array(
            self::VAR_DATA_TYPE => 'integer',
            self::VAR_PHP_DATA_TYPE => 'int',
            self::VAR_TYPE_ARTICLE => 'an',
            self::VAR_COLLECTION_PREFIX => 'IntegerPrimary',
            self::VAR_SORT_STATEMENT => '$a->getID() - $b->getID()'
        ),
    );

    public function build() : void
    {
        $templateFiles = array(
            __DIR__.'/../../../templates/collection-trait-skeleton.php.spf' => __DIR__ . '/../../Traits/{COLLECTION_PREFIX}CollectionTrait.php',
            __DIR__.'/../../../templates/basket-trait-skeleton.php.spf' => __DIR__ . '/../../Baskets/{COLLECTION_PREFIX}BasketTrait.php'
        );

        foreach($templateFiles as $templateFile => $traitFile) {
            $this->buildFromTemplate($templateFile, $traitFile);
        }
    }

    private function buildFromTemplate(string $templateFile, string $baseTraitFile) : void
    {
        $php = file_get_contents($templateFile);

        if($php === false) {
            throw new TraitBuilderException(
                'Could not read the template file.',
                sprintf(
                    'Looked in [%s].',
                    $templateFile
                ),
                TraitBuilderException::ERROR_CANNOT_READ_TEMPLATE_FILE
            );
        }

        foreach(self::DATA_TYPES as $vars)
        {
            $vars[self::VAR_GENERATION_DATE] = date('Y-m-d H:i:s');
            $typePHP = $php;
            $traitFile = $baseTraitFile;

            foreach($vars as $var => $value) {
                $traitFile = str_replace('{' . $var . '}', $value, $traitFile);
                $typePHP = str_replace('{' . $var . '}', $value, $typePHP);
            }

            if(!file_put_contents($traitFile, $typePHP)) {
                throw new TraitBuilderException(
                    'Could not write the trait file.',
                    sprintf(
                        'Tried to write to [%s].',
                        $traitFile
                    ),
                    TraitBuilderException::ERROR_CANNOT_WRITE_TRAIT_FILE
                );
            }
        }
    }
}
