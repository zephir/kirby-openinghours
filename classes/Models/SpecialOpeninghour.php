<?php

namespace Zephir\Openinghours\Models;

use Kirby\Toolkit\Date;

class SpecialOpeninghour
{

    /**
     * @var string
     */
    protected $label;

    /**
     * @var Date
     */
    protected $date;

    /**
     * @var bool
     */
    protected $isClosed;

    /**
     * @var Timeblock[]
     */
    protected $timeblocks;

    public function __construct($label, Date $date, $timeblocks = [], $isClosed = false)
    {
        $this->label = $label;
        $this->date = $date;
        $this->isClosed = $isClosed;

        $this->setTimeblocks($timeblocks);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function isClosed()
    {
        return $this->isClosed;
    }

    public function isActive()
    {
        return $this->date->floor('day')->is((new Date())->floor('day'));
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

    /**
     * @param string $format The format to use for the date, if false, the Date object will be returned
     * @param mixed $handler The handler to use for the date (see kirby date handler), if null, the default handler will be used
     * @return string|Date
     */
    public function getDate($format = false, $handler = null)
    {
        $date = $this->date;

        if (!$date) {
            return null;
        }

        if ($format) {
            return $date->formatWithHandler($format, $handler);
        }

        return $date;
    }

    public function setTimeblocks($timeblocks)
    {
        $this->timeblocks = array_filter(
            array_map(function ($timeblock) {
                if (!isset($timeblock['start']) || !isset($timeblock['end'])) {
                    return null;
                }

                return new Timeblock($timeblock['start'], $timeblock['end']);
            }, $timeblocks),
            fn ($timeblock) => $timeblock !== null
        );
    }

}