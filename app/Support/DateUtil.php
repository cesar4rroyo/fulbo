<?php


namespace App\Support;


use Illuminate\Support\DateFactory;

class DateUtil
{
    /**
     * @var DateFactory
     */
    private DateFactory $dateFactory;

    public function __construct(DateFactory $dateFactory)
    {

        $this->dateFactory = $dateFactory;
    }

    public function getLocalDays(): array
    {
        $result = [];

        foreach ($this->dateFactory->getDays() as $index => $day) {
            $result[$index] = $this->dateFactory
                ->create($day)
                ->format('l');
        }

        return $result;
    }

    public function getDayNameByIndex(int $index): string
    {
        return $this->getLocalDays()[$index];
    }
}