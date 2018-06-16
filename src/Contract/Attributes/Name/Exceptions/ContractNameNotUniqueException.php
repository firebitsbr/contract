<?php

namespace Railken\LaraOre\Contract\Attributes\Name\Exceptions;

use Railken\LaraOre\Contract\Exceptions\ContractAttributeException;

class ContractNameNotUniqueException extends ContractAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'CONTRACT_NAME_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
