<?php

namespace Railken\LaraOre\Contract\Attributes\EndsAt\Exceptions;

use Railken\LaraOre\Contract\Exceptions\ContractAttributeException;

class ContractEndsAtNotDefinedException extends ContractAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'ends_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'CONTRACT_ENDS_AT_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}