<?php


class AMC_304h_STG2_Denominator implements AmcFilterIF
{
    public function getTitle()
    {
        return "AMC_304h_STG2 Denominator";
    }

    public function test(AmcPatient $patient, $beginDate, $endDate)
    {
        //  (basically needs a encounter within the report dates,
        //   which are already filtered for, so all the objects are a positive)
        return true;
    }
}
