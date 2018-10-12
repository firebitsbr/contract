<?php

namespace Railken\Amethyst\Schemas;

use Railken\Amethyst\Managers\CatalogueManager;
use Railken\Amethyst\Managers\ContractManager;
use Railken\Amethyst\Managers\ProductManager;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class ContractProductSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\BelongsToAttribute::make('catalogue_id')
                ->setRelationName('catalogue')
                ->setRelationManager(CatalogueManager::class),
            Attributes\BelongsToAttribute::make('contract_id')
                ->setRelationName('contract')
                ->setRelationManager(ContractManager::class),
            Attributes\BelongsToAttribute::make('product_id')
                ->setRelationName('product')
                ->setRelationManager(ProductManager::class),
            Attributes\DateTimeAttribute::make('last_bill_at'),
            Attributes\DateTimeAttribute::make('next_bill_at'),
            Attributes\DateTimeAttribute::make('starts_at'),
            Attributes\DateTimeAttribute::make('ends_at'),
            Attributes\NumberAttribute::make('renewals'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}