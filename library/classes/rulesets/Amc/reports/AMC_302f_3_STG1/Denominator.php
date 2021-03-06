<?php


class AMC_302f_3_STG1_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_302f_3_STG1 Denominator";
    }
    
    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //Number of unique patients 3 years of age or older seen by the EP during the EHR reporting period (Effective through 2013 only)
        $options = array( Encounter::OPTION_ENCOUNTER_COUNT => 1 );
        if ((Helper::checkAnyEncounter($patient, $beginDate, $endDate, $options)) &&
             ($patient->calculateAgeOnDate($endDate) >= 3) ) {
            return true;
        } else {
            return false;
        }
    }
}
