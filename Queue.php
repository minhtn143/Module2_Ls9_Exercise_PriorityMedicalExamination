<?php


class Queue
{
    const EMERGENCY = 1;
    const VVIP = 4;
    const VIP = 5;
    const NORMAL = 6;
    const LIMIT = 5;
    const ALERT_EMPTY_MESSAGE = "THIS QUEUE IS EMPTY!";
    const ALERT_FULL_MESSAGE = "THIS QUEUE IS FULL!";

    protected $queueList;
    protected $size;

    public function __construct()
    {
        $this->queueList = [self::EMERGENCY => [], self::VVIP => [], self::VIP => [], self::NORMAL => []];
        $this->size = 0;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

    public function enqueue($name, $code)
    {
        if ($this->isFull()) {
            echo self::ALERT_FULL_MESSAGE;
        } else {
            $patient = new Patient($name, $code);
            array_push($this->queueList[$code], $patient);
            $this->size++;
        }
    }

    public function dequeue()
    {
        if ($this->isEmpty()) {
            return null;
        }
        $dequeueItem = [];
        if (!empty($this->queueList[self::EMERGENCY])) {
            $dequeueItem = array_shift($this->queueList[self::EMERGENCY]);
        } else {
            if (!empty($this->queueList[self::VVIP])) {
                $dequeueItem = array_shift($this->queueList[self::VVIP]);
            } else {
                if (!empty($this->queueList[self::VIP])) {
                    $dequeueItem = array_shift($this->queueList[self::VIP]);
                } else {
                    if (!empty($this->queueList[self::NORMAL])) {
                        $dequeueItem = array_shift($this->queueList[self::NORMAL]);
                    }
                }
            }
        }
        $this->size--;
        return $dequeueItem;
    }

    public function showQueue()
    {
        $display = [];
        if ($this->isEmpty()) {
            $display = self::ALERT_EMPTY_MESSAGE;
        } else {
            foreach ($this->queueList as $key => $patient) {
                foreach ($patient as $item) {
                    array_push($display, $item);
                }
            }
        }

        return $display;
    }

    public function isFull()
    {
        return $this->size >= self::LIMIT;
    }

}