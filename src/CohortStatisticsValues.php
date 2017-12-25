<?php

namespace AdjustKPIService;

use AdjustKPIService\AbstractStatisticsValues;

class CohortStatisticsValues extends AbstractStatisticsValues
{
    const REQUEST_PARAM_PERIOD = 'period';
    const REQUEST_PARAM_REATTRIBUTED = 'reattributed';
    const REQUEST_PARAM_EVENTS = 'events';

    const REQUEST_VALUE_PREIOD_DAY = 'day';
    const REQUEST_VALUE_PREIOD_WEEK = 'week';
    const REQUEST_VALUE_PREIOD_MONTH = 'month';

    const REQUEST_VALUE_GROUPING_PERIODS = 'periods';

    const COHORT_KPIS_VALUE_RETAINED_USERS = 'retained_users';
    const COHORT_KPIS_VALUE_COHORT_SIZE = 'cohort_size';
    const COHORT_KPIS_VALUE_RETENTION_RATE = 'retention_rate';
    const COHORT_KPIS_VALUE_SESSIONS = 'sessions';
    const COHORT_KPIS_VALUE_SESSIONS_PER_USER = 'sessions_per_user';
    const COHORT_KPIS_VALUE_REVENUE = 'revenue';
    const COHORT_KPIS_VALUE_REVENUE_TOTAL = 'revenue_total';
    const COHORT_KPIS_VALUE_REVENUE_PER_USER = 'revenue_per_user';
    const COHORT_KPIS_VALUE_REVENUE_PER_PAYING_USER = 'revenue_per_paying_user';
    const COHORT_KPIS_VALUE_REVENUE_TOTAL_IN_COHORT = 'revenue_total_in_cohort';
    const COHORT_KPIS_VALUE_LIFETIME_VALUE = 'lifetime_value';
    const COHORT_KPIS_VALUE_PAYING_USER_LIFETIME_VALUE = 'paying_user_lifetime_value';
    const COHORT_KPIS_VALUE_TIME_SPENT = 'time_spent';
    const COHORT_KPIS_VALUE_TIME_SPENT_PER_USER = 'time_spent_per_user';
    const COHORT_KPIS_VALUE_TIME_SPENT_PER_SESSION = 'time_spent_per_session';
    const COHORT_KPIS_VALUE_PAYING_USERS = 'paying_users';
    const COHORT_KPIS_VALUE_PAYING_USER_SIZE = 'paying_user_size';
    const COHORT_KPIS_VALUE_PAYING_USERS_RETENTION_RATE = 'paying_users_retention_rate';
    const COHORT_KPIS_VALUE_PAYING_USER_RATE = 'paying_user_rate';
    const COHORT_KPIS_VALUE_REVENUE_EVENTS = 'revenue_events';
    const COHORT_KPIS_VALUE_REVENUE_EVENTS_PER_USER = 'revenue_events_per_user';
    const COHORT_KPIS_VALUE_REVENUE_EVENTS_PER_ACTIVE_USER = 'revenue_events_per_active_user';
    const COHORT_KPIS_VALUE_REVENUE_EVENTS_PER_PAYING_USER = 'revenue_events_per_paying_user';
    const COHORT_KPIS_VALUE_CONVERTED_USERS = 'converted_users';
    const COHORT_KPIS_VALUE_CONVERTED_USER_SIZE = 'converted_user_size';
    const COHORT_KPIS_VALUE_CONVERSION_DISTRIBUTION = 'conversion_distribution';
    const COHORT_KPIS_VALUE_CONVERSION_PER_USER = 'conversion_per_user';
    const COHORT_KPIS_VALUE_CONVERSION_PER_ACTIVE_USER = 'conversion_per_active_user';
    const COHORT_KPIS_VALUE_EVENTS = 'events';
    const COHORT_KPIS_VALUE_EVENTS_PER_CONVERTED_USER = 'events_per_converted_user';
    const COHORT_KPIS_VALUE_EVENTS_PER_USER = 'events_per_user';
    const COHORT_KPIS_VALUE_EVENTS_PER_ACTIVE_USER = 'events_per_active_user';

    public function getCohortKPIListForRequest()
    {
        return join(',', $this->getCohortKPIList());
    }

    public function getCohortKPIList()
    {
        return $this->getConstantListOf('COHORT_KPIS_VALUE_');
    }
}

