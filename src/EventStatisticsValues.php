<?php

namespace AdjustKPIService;

use AdjustKPIService\AbstractStatisticsValues;

class EventStatisticsValues extends AbstractStatisticsValues
{
    const REQUEST_PARAM_EVENTS = 'events';

    public function getEventKPIListForRequest()
    {
        return join(',', $this->getEventKPIList());
    }
}

