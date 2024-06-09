<?php

namespace Zephir\Openinghours\Helpers;

use DateInterval;
use DatePeriod;
use Kirby\Toolkit\Date;

class Daterange {

    protected DatePeriod $datePeriod;

    public function __construct(Date $startDate, Date $endDate) {
        $this->datePeriod = new DatePeriod(
            $startDate,
            new DateInterval('P1D'),
            $endDate,
            DatePeriod::INCLUDE_END_DATE
        );
    }

    public function includes(Date|null $date) {
        return $date->isBetween($this->datePeriod->getStartDate(), $this->datePeriod->getEndDate());
    }

    public function getStartDate()
    {
        return $this->datePeriod->getStartDate();
    }

    public function getEndDate()
    {
        return $this->datePeriod->getEndDate();
    }
}