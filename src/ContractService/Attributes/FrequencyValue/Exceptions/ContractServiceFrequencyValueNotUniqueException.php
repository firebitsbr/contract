<?php

namespace Railken\LaraOre\ContractService\Attributes\FrequencyValue\Exceptions;

use Railken\LaraOre\ContractService\Exceptions\ContractServiceAttributeException;

class ContractServiceFrequencyValueNotUniqueException extends ContractServiceAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'frequency_value';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'CONTRACTSERVICE_FREQUENCY_VALUE_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}