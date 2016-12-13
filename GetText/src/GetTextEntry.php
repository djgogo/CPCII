<?php
declare(strict_types = 1);

namespace GetText
{
    class GetTextEntry
    {
        /**
         * @var int
         */
        private $id;

        /**
         * @var string
         */
        private $msgId;

        /**
         * @var string
         */
        private $msgStr;

        /**
         * @var \DateTime
         */
        private $importDate;

        /**
         * @var \DateTime
         */
        private $updated;

        public function getId() : int
        {
            return $this->id;
        }

        public function getMsgId() : string
        {
            return $this->msgId;
        }

        public function setMsgId($msgId)
        {
            $this->msgId = $msgId;
        }

        public function getMsgStr() : string
        {
            return $this->msgStr;
        }

        public function setMsgStr($msgStr)
        {
            $this->msgStr = $msgStr;
        }

        public function getImportDate() : \DateTime
        {
            return $this->importDate;
        }

        public function getUpdated() : \DateTime
        {
            return $this->updated;
        }
    }
}
