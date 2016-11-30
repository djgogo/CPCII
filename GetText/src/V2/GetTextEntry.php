<?php
declare(strict_types = 1);

namespace GetText\V2
{
    class GetTextEntry
    {
        /**
         * @var string
         */
        private $msgId;

        /**
         * @var string
         */
        private $msgStr;

        public function __construct(string $msgId, string $msgStr)
        {
            $this->msgId = $msgId;
            $this->msgStr = $msgStr;
        }

        public function getMsgId() : string
        {
            return $this->msgId;
        }

        public function getMsgStr() : string
        {
            return $this->msgStr;
        }
    }
}
