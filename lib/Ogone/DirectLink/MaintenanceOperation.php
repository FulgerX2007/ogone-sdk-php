<?php
namespace Ogone\DirectLink;


class MaintenanceOperation implements \Stringable
{
    final public const OPERATION_AUTHORISATION_RENEW = 'REN';
    final public const OPERATION_AUTHORISATION_DELETE = 'DEL';
    final public const OPERATION_AUTHORISATION_DELETE_AND_CLOSE = 'DES';
    final public const OPERATION_CAPTURE_PARTIAL = 'SAL';
    final public const OPERATION_CAPTURE_LAST_OR_FULL = 'SAS';
    final public const OPERATION_REFUND_PARTIAL = 'RFD';
    final public const OPERATION_REFUND_LAST_OR_FULL = 'RFS';

    protected $operation;

    public function __construct($operation)
    {
        if(!in_array($operation, self::getAllAvailableOperations())) {
            throw new \InvalidArgumentException('Unknown Operation: ' . $operation);
        }

        $this->operation = $operation;
    }

    public function equals(MaintenanceOperation $other)
    {
        return $this->operation === $other->operation;
    }

    public function __toString(): string
    {
        return (string) $this->operation;
    }

    private function getAllAvailableOperations()
    {
        return [self::OPERATION_AUTHORISATION_RENEW, self::OPERATION_AUTHORISATION_DELETE, self::OPERATION_AUTHORISATION_DELETE_AND_CLOSE, self::OPERATION_CAPTURE_PARTIAL, self::OPERATION_CAPTURE_LAST_OR_FULL, self::OPERATION_REFUND_PARTIAL, self::OPERATION_REFUND_LAST_OR_FULL];
    }
} 