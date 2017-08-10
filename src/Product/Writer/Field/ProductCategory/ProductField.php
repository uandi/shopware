<?php declare(strict_types=1);

namespace Shopware\Product\Writer\Field\ProductCategory;

use Shopware\Framework\Validation\ConstraintBuilder;
use Shopware\Product\Writer\Api\VirtualField;

class ProductField extends VirtualField
{
    public function __construct()
    {
        parent::__construct('product', \Shopware\Product\Writer\Field\ProductCategory\ProductUuidField::class);
    }
}