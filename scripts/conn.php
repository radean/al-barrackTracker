<?php
/**
 * Created by IntelliJ IDEA.
 * User: VisionVr
 * Date: 1/22/2019
 * Time: 1:38 PM
 */
// Create connection to Oracle
//error_reporting(0);
$conn = oci_connect("barrak", "gway2020", "212.12.184.109/barrak");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
else {
    if (isset($_POST["bl_number"])){
        $blNumber = $_POST["bl_number"];
        $tableNumber = 'SHP_T_BL_CNTR, SHP_T_BL_HDR';


//        ARRAYS
//        ['SHP_T_BL_HDR',
//        'SHP_T_BL_ADDR',
//        'SHP_T_BL_ARABIC',
//        'SHP_T_BL_BULK_DTL',
//        'SHP_T_BL_CLAIMS',
//        'SHP_T_BL_CNTR',
//        'SHP_T_BL_CNTR_DANG',
//        'SHP_T_BL_CORR',
//        'SHP_T_BL_FRGHT',
//        'SHP_T_BL_GUARANT',
//        'SHP_T_BL_INTIM',
//        'SHP_T_BL_RORO_DTL',
//        'SHP_T_DET_REMIT_DTL',
//        'SHP_T_REMIT_DTL',
//        'SHP_T_VOUCH_HDR'];
//      CLOSING
        $selectedTablesArray =
        ['SHP_T_BL_HDR',
        'SHP_T_BL_CNTR'];
        $selectedTablesSql = '';
        $selectedTablesSqlColumns = '';

//        ADDITIONAL SELECTED
        $additionalSelectedTablesSqlColumns =
        'SHP_T_BL_CNTR.CNTR_NUM,
        SHP_T_BL_CNTR.CNTR_NUM,
        SHP_T_BL_CNTR.GROSS_WGT,
        SHP_T_BL_CNTR.SEAL_NUM';
        $tableCondition = '';


//        Parsing the array to strings
        $nameKey = 0;
        foreach ($selectedTablesArray as $name){
            if ($nameKey == 0){
                $selectedTablesSql = $name;
            } else {
                $selectedTablesSql = $selectedTablesSql.", ".$name;
            }
            $nameKey++;

        }
//        Parsing Selected table columns into required fields
        $sNameKey = 0;
        foreach ($selectedTablesArray as $name){
            if ($sNameKey == 0){
                $selectedTablesSqlColumns = $name.".BL_NUM";
                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".BRN_ID ";
//                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".CNTR_NUM";
            } else {
                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".BL_NUM";
                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".BRN_ID";
//                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".CNTR_NUM";
            }
            $sNameKey++;
        }
//        Setting conditions
        $sNameKey = 0;
        foreach ($selectedTablesArray as $name){
            if ($sNameKey == 0){
                $selectedTablesSqlColumns = $name.".BL_NUM";
                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".BRN_ID";
//                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".CNTR_NUM";
            } else {
                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".BL_NUM";
                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".BRN_ID";
//                $selectedTablesSqlColumns = $selectedTablesSqlColumns.", ".$name.".CNTR_NUM";
            }
            $sNameKey++;
        }

//        echo $selectedTablesSqlColumns;
//        print $blNumber;
//        print $tableNumber;
        //    print "Connected to Oracle!";
        //    Parsing Data

//        $selectedTablesSqlColumns =
//        'SHP_T_BL_CNTR.BL_NUM,
//        SHP_T_BL_CNTR.BRN_ID,
//        SHP_T_BL_CNTR.DIV_ID,
//        SHP_T_BL_CNTR.COMP_ID,
//        SHP_T_BL_CNTR.CNTR_NUM,
//        SHP_T_BL_HDR.BL_NUM,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,
//        SHP_T_BL_HDR.BRN_ID,';
//        $sqlConditions = '(SHP_T_BL_HDR.BL_NUM = \'$blNumber\' AND SHP_T_BL_CNTR.BL_NUM = \'$blNumber\')';
        $sqlText = "SELECT
                    $selectedTablesSqlColumns, $additionalSelectedTablesSqlColumns
                    FROM $selectedTablesSql
                    WHERE (SHP_T_BL_HDR.BL_NUM = '$blNumber' AND SHP_T_BL_CNTR.BL_NUM = '$blNumber')";
//        print $sqlText;
        $sqlParse = oci_parse( $conn , $sqlText);
        oci_execute($sqlParse);
    }

}



// Close the Oracle connection
//oci_close($conn);
