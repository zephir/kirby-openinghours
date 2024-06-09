<?php

namespace Zephir\Openinghours\Models;
use Kirby\Toolkit\Date;

class Weekday {

    /**
     * @var string
     */
    protected string $dayCode;

    /**
     * @var bool
     */
    protected bool $isClosed = false;

    /**
     * @var Timeblock[]
     */
    protected array $timeblocks = [];

    /**
     * @param string $dayCode
     * @param bool $isClosed
     * @param Timeblock[] $timeblocks
     */
    public function __construct(string $dayCode, bool $isClosed, array $timeblocks)
    {
        $this->dayCode = $dayCode;
        $this->isClosed = $isClosed;
        $this->setTimeblocks($timeblocks);
    }

    /**
     * @return string
     */
    public function getFormattedTime()
    {
        $timeblocks = array_map(function($timeblock) {
            return $timeblock->getFormatted();
        }, $this->timeblocks);

        return 'von ' . implode(' und ', $timeblocks) . ' Uhr';
    }

    public function isClosed()
    {
        return $this->isClosed;
    }

    public function getDayCode()
    {
        return $this->dayCode;
    }

    public function getTimeblocks()
    {
        return $this->timeblocks;
    }

    /**
     * @param array $timeblocks
     */
    public function setTimeblocks($timeblocks)
    {
        $this->timeblocks = array_filter(
            array_map(function($timeblock) {
                if (empty($timeblock['start']) || empty($timeblock['end'])) {
                    return null;
                }

                return new Timeblock($timeblock['start'], $timeblock['end']);
            }, $timeblocks),
            fn ($timeblock) => $timeblock !== null
        );

        return $this;
    }

    public function isToday()
    {
        return $this->getDayCode() === strtolower(substr(date('D'), 0, 2));
    }
}