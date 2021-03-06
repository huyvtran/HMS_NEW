<?php



    //Initialization of QRDA Elements
    //QRDA Needed Race
    $mainQrdaRaceCodeArr =  array('amer_ind_or_alaska_native'=>'1002-5', 'Asian'=>'2028-9', 'black_or_afri_amer'=>'2054-5', 'native_hawai_or_pac_island'=>'2076-8', 'white'=>'2106-3', 'Asian_Pacific_Island'=>'2131-1', 'Black_not_of_Hispan'=>'2131-1', 'Hispanic'=>'2131-1', 'White_not_of_Hispan'=>'2131-1');
    
    //QRDA Needed Ethnicity
    $mainEthiCodeArr =  array('not_hisp_or_latin'=>'2186-5', 'hisp_or_latin'=>'2135-2');
    
    //QRDA Needed Payer Info
    $mainQrdaPayerCodeSendArr = array();
    $encCheckUniqId = array();
    $mainQrdaPayerCodeSendArr['Medicare'] = "1";
    $mainQrdaPayerCodeSendArr['Medicaid'] = "2";
    $mainQrdaPayerCodeSendArr['Private Health Insurance'] = "5";
    $mainQrdaPayerCodeSendArr['Other'] = "349";
    
    //QRDA
    $preDefinedUniqIDRules = array();
    $preDefinedUniqIDRules['0101'] = '40280381-4555-E1C1-0145-672613970D15';
    $preDefinedUniqIDRules['0043'] = '40280381-4555-E1C1-0145-762578A81C4C';
    $preDefinedUniqIDRules['0421'] = '40280381-4555-E1C1-0145-D2B36DBB3FE6';
    $preDefinedUniqIDRules['0038'] = '40280381-4555-E1C1-0145-D7C003364261';
    $preDefinedUniqIDRules['0028'] = '40280381-4600-425F-0146-1F5867D40E82';
    $preDefinedUniqIDRules['0384'] = '40280381-4600-425F-0146-1F620BDF0EB0';
    $preDefinedUniqIDRules['0002'] = '40280381-4600-425F-0146-1F6E280C0F09';
    $preDefinedUniqIDRules['0018'] = '40280381-4600-425F-0146-1F6F722B0F17';
    $preDefinedUniqIDRules['0013'] = '40280381-4600-425F-0146-1F6F722B0F17';
    $preDefinedUniqIDRules['0024'] = '40280381-4555-E1C1-0145-85C7311720F5';
    $preDefinedUniqIDRules['0059'] = '40280381-4555-E1C1-0145-90AC70DE2C73';
    $preDefinedUniqIDRules['0041'] = '40280381-4600-425F-0146-EE66F0005509';
    
    $qrda_file_path = $GLOBALS['OE_SITE_DIR'] . "/documents/cqm_qrda/";
    
    $EncounterCptCodes = array('ophthalmological_services' => '92002');
    
function getCombinePatients($dataSheet, $reportID)
{
    foreach ($dataSheet as $singleDataSheet) {
        //var_dump($singleDataSheet['cqm_nqf_code'],$singleDataSheet['init_patients']);
        if (count($cqmCodes) && in_array($singleDataSheet['cqm_nqf_code'], $cqmCodes)) {
            $initPatArr = collectItemizedPatientsCdrReport($reportID, $singleDataSheet['itemized_test_id'], "init_patients");
            $fullPatArr = array();
            foreach ($initPatArr as $initPatInfo) {
                $fullPatArr[] = $initPatInfo['pid'];
            }

            $patients[$singleDataSheet['cqm_nqf_code']] = array_merge($patients[$singleDataSheet['cqm_nqf_code']], $fullPatArr);
            $patients[$singleDataSheet['cqm_nqf_code']] = array_unique($patients[$singleDataSheet['cqm_nqf_code']]);
        } else {
            $cqmCodes[] = $singleDataSheet['cqm_nqf_code'];
            $initPatArr = collectItemizedPatientsCdrReport($reportID, $singleDataSheet['itemized_test_id'], "init_patients");
            $fullPatArr = array();
            foreach ($initPatArr as $initPatInfo) {
                $fullPatArr[] = $initPatInfo['pid'];
            }

            $patients[$singleDataSheet['cqm_nqf_code']] = $fullPatArr;
        }
    }

    return $patients;
}
