<?php
namespace Bidpath\Tt3UnitTesting;

class Result
{
    public const OK_BY_USER = 1;
    public const OK_BY_AUCTION_USER = 2;
    public const OK_BY_DATE = 3;
    public const OK_BY_FILE = 4;
    public const OK_BY_RAND = 5;

    public const ERR_USER_ABSENT = 11;
    public const ERR_FILE_ABSENT = 12;
    public const ERR_FILE_AMOUNT_INVALID = 13;
    public const ERR_FILE_AMOUNT_NEGATIVE = 14;
    public const ERR_AMOUNT_NOT_FOUND = 15;

    public ?float $amount = null;
    public ?int $status = null;

    public function __construct(?float $amount, int $status)
    {
        $this->amount = $amount;
        $this->status = $status;
    }

    public static function failed(int $errorStatus): self
    {
        return new static(null, $errorStatus);
    }
}
