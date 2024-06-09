<?php

namespace Zephir\Openinghours\Models;

use Kirby\Toolkit\Date;
use Zephir\Openinghours\Helpers\Daterange;

class Openinghour {

    /**
     * @var string
     */
    protected string|null $label;

    /**
     * @var bool
     */
    protected bool $isDefault = false;

    /**
     * @var Daterange|null
     */
    protected Daterange|null $daterange = null;

    /**
     * @var Weekdays|null
     */
    protected Weekdays|null $weekdays = null;

    /**
     * @var bool
     */
    protected bool $isHidden = false;

    protected bool $isActive = false;

    /**
     * @param string|null $label
     * @param array $weekdays
     * @param Daterange|null $daterange
     * @param bool $isDefault
     */
    public function __construct(array $weekdays, bool $isDefault = false, string|null $label = null, Daterange|null $daterange = null, bool $isHidden = false) {
        $this->label = $label;
        $this->isDefault = $isDefault;
        $this->daterange = $daterange;
        $this->isHidden = $isHidden;

        $this->setWeekdays($weekdays);
    }

    /**
     * @param string $format The format to use for the date, if false, the Date object will be returned
     * @param mixed $handler The handler to use for the date (see kirby date handler), if null, the default handler will be used
     * @return Date|bool|int|string|null
     */
    public function getStartDate($format = false, $handler = null)
    {
        return $this->getDate('start', $format, $handler);
    }

    /**
     * @param string $format The format to use for the date, if false, the Date object will be returned
     * @param mixed $handler The handler to use for the date (see kirby date handler), if null, the default handler will be used
     * @return Date|bool|int|string|null
     */
    public function getEndDate($format = false, $handler = null)
    {
        return $this->getDate('end', $format, $handler);
    }

    public function getHumanReadable()
    {
        return $this->weekdays->getHumanReadable();
    }

    private function getDate($name, $format = false, $handler = null)
    {
        if (!$this->daterange) {
            return null;
        }

        $date = $this->daterange->{"get" . ucfirst($name) . "Date"}();

        if (!$date) {
            return null;
        }

        if ($format) {
            return $date->formatWithHandler($format, $handler);
        }

        return $date;
    }

    /**
     * Get the label
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Check if it is the default opening hour
     *
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * Get the date range
     *
     * @return Daterange|null
     */
    public function getDateRange(): ?Daterange
    {
        return $this->daterange;
    }

    /**
     * Get the weekdays
     *
     * @return Weekdays|null
     */
    public function getWeekdays(): Weekdays|null
    {
        return $this->weekdays;
    }

    /**
     * Check if it is hidden
     *
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->isHidden;
    }

    /**
     * Check if it is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    public function setWeekdays($weekdays)
    {
        $this->weekdays = new Weekdays($weekdays);
        return $this;
    }

}