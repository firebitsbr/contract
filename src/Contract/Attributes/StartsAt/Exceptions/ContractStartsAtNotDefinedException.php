<?php

namespace Railken\LaraOre\Contract\Attributes\StartsAt\Exceptions;

use Railken\LaraOre\Contract\Exceptions\ContractAttributeException;

class ContractStartsAtNotDefinedException extends ContractAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'starts_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'CONTRACT_STARTS_AT_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
