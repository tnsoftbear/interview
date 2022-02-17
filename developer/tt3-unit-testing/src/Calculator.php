<?php
namespace Bidpath\Tt3UnitTesting;

use Bidpath\Tt3UnitTesting\Internal\Auction\AuctionAmountService;
use Bidpath\Tt3UnitTesting\Internal\User\UserAmountService;
use DateTime;

class Calculator
{
    public int $dateAmount = 0;
    public int $randRate = 0;

    public function __construct(int $dateAmount = 0, int $randRate = 0) {
        $this->dateAmount = $dateAmount;
        $this->randRate = $randRate;
    }

    public function calculate(
        ?int $userId = null,
        ?int $auctionId = null,
        ?DateTime $dateAt = null,
        string $filename = ''
    ): Result {
        if (
            $userId
            && $auctionId
        ) {
            $auctionAmount = (new AuctionAmountService())->loadAmount($auctionId, $userId);
            if ($auctionAmount) {
                return new Result($auctionAmount, Result::OK_BY_AUCTION_USER);
            }
        }

        if ($userId) {
            $userAmountService = new UserAmountService();
            if (!$userAmountService->existUserById($userId)) {
                return Result::failed(Result::ERR_USER_ABSENT);
            }

            $userAmount = $userAmountService->loadAmount($userId);
            if ($userAmount) {
                return new Result($userAmount, Result::OK_BY_USER);
            }
        }

        if (
            $dateAt
            && $dateAt < new DateTime("now")
        ) {
            return new Result($this->dateAmount, Result::OK_BY_DATE);
        }

        if ($filename) {
            if (!file_exists($filename)) {
                return Result::failed(Result::ERR_FILE_ABSENT);
            }

            $fileAmount = file_get_contents($filename);
            if (!is_numeric($fileAmount)) {
                return Result::failed(Result::ERR_FILE_AMOUNT_INVALID);
            }

            $fileAmount = (float)$fileAmount;
            if ($fileAmount < 0) {
                return Result::failed(Result::ERR_FILE_AMOUNT_NEGATIVE);
            }

            return new Result($fileAmount, Result::OK_BY_FILE);
        }

        if ($this->randRate) {
            $randAmount = random_int(0, 10) * 10;
            if ($randAmount >= $this->randRate) {
                return new Result($randAmount, Result::OK_BY_RAND);
            }
        }

        return Result::failed(Result::ERR_AMOUNT_NOT_FOUND);
    }
}
