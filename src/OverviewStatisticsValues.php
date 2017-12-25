<?php

namespace AdjustKPIService;

use AdjustKPIService\AbstractStatisticsValues;

class OverviewStatisticsValues extends AbstractStatisticsValues
{
    const KPIS_VALUE_APP_CLICKS = 'clicks';
    const KPIS_VALUE_APP_IMPRESSIONS = 'impressions';
    const KPIS_VALUE_APP_INSTALLS = 'installs';
    const KPIS_VALUE_APP_CLICK_CONVERSION_RATE = 'click_conversion_rate';
    const KPIS_VALUE_APP_CTR = 'ctr';
    const KPIS_VALUE_APP_IMPRESSION_CONVERSION_RATE = 'impression_conversion_rate';
    const KPIS_VALUE_APP_REATTRIBUTIONS = 'reattributions';
    const KPIS_VALUE_APP_SESSIONS = 'sessions';
    const KPIS_VALUE_APP_REVENUE_EVENTS = 'revenue_events';
    const KPIS_VALUE_APP_REVENUE = 'revenue';
    const KPIS_VALUE_APP_DAUS = 'daus';
    const KPIS_VALUE_APP_WAUS = 'waus';
    const KPIS_VALUE_APP_MAUS = 'maus';
    const KPIS_VALUE_APP_LIMIT_AD_TRACKING_INSTALLS = 'limit_ad_tracking_installs';
    const KPIS_VALUE_APP_LIMIT_AD_TRACKING_INSTALL_RATE = 'limit_ad_tracking_install_rate';
    const KPIS_VALUE_APP_LIMIT_AD_TRACKING_REATTRIBUTIONS = 'limit_ad_tracking_reattributions';
    const KPIS_VALUE_APP_LIMIT_AD_TRACKING_REATTRIBUTIONS_RATE = 'limit_ad_tracking_reattribution_rate';

    const FRAUD_KPIS_VALUE_REJECTED_INSTALLS = 'rejected_installs';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALLS_ANON_IP = 'rejected_installs_anon_ip';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALLS_TOO_MANY_ENGAGEMENTS = 'rejected_installs_too_many_engagements';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALLS_DISTRIBUTION_OUTLIER = 'rejected_installs_distribution_outlier';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTIONS = 'rejected_reattributions';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTIONS_ANON_IP = 'rejected_reattributions_anon_ip';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTIONS_TOO_MANY_ENGAGEMENTS = 'rejected_reattributions_too_many_engagements';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTIONS_DISTRIBUTION_OUTLIER = 'rejected_reattributions_distribution_outlier';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALL_RATE = 'rejected_install_rate';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALL_ANON_IP_RATE = 'rejected_install_anon_ip_rate';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALL_TOO_MANY_ENGAGEMENTS_RATE = 'rejected_install_too_many_engagements_rate';
    const FRAUD_KPIS_VALUE_REJECTED_INSTALL_DISTRIBUTION_OUTLIER_RATE = 'rejected_install_distribution_outlier_rate';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTION_RATE = 'rejected_reattribution_rate';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTION_ANON_IP_RATE = 'rejected_reattribution_anon_ip_rate';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTION_TOO_MANY_ENGAGEMENTS_RATE = 'rejected_reattribution_too_many_engagements_rate';
    const FRAUD_KPIS_VALUE_REJECTED_REATTRIBUTION_DISTRIBUTION_OUTLIER_RATE = 'rejected_reattribution_distribution_outlier_rate';

    const COST_KPIS_VALUE_INSTALL_COST = 'install_cost';
    const COST_KPIS_VALUE_CLICK_COST = 'click_cost';
    const COST_KPIS_VALUE_IMPRESSION_COST = 'impression_cost';
    const COST_KPIS_VALUE_COST = 'cost';
    const COST_KPIS_VALUE_PAID_INSTALLS = 'paid_installs';
    const COST_KPIS_VALUE_PAID_CLICKS = 'paid_clicks';
    const COST_KPIS_VALUE_PAID_IMPRESSIONS = 'paid_impressions';
    const COST_KPIS_VALUE_ECPC = 'ecpc';
    const COST_KPIS_VALUE_ECPM = 'ecpm';
    const COST_KPIS_VALUE_ECPI = 'ecpi';
    const COST_KPIS_VALUE_COHORT_GROSS_PROFIT = 'cohort_gross_profit';
    const COST_KPIS_VALUE_RETURN_ON_INVESTMENT = 'return_on_investment';
}

