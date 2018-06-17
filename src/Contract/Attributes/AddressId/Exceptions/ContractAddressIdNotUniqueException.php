<?php

namespace Railken\LaraOre\Contract\Attributes\AddressId\Exceptions;

use Railken\LaraOre\Contract\Exceptions\ContractAttributeException;

class ContractAddressIdNotUniqueException extends ContractAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'address_id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'CONTRACT_ADDRESS_ID_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
