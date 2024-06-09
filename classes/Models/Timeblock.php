<?php

namespace Zephir\Openinghours\Models;

class Timeblock {

        /**
         * @var string
         */
        private string $start;

        /**
         * @var string
         */
        private string $end;

        /**
         * @param string $start
         * @param string $end
        */
        public function __construct(string $start, string $end) {
            $this->start = $start;
            $this->end = $end;
        }

        /**
         * @return string
        */
        public function getStart(): string {
            return str_replace(':00', '', $this->start);
        }

        /**
         * @return string
         */
        public function getEnd(): string {
            return str_replace(':00', '', $this->end);
        }

        public function getFormatted(): string {
            return $this->getStart() . ' bis ' . $this->getEnd();
        }
}