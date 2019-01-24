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
//        print $blNumber;
//        print $tableNumber;
        //    print "Connected to Oracle!";
        //    Parsing Data
//        All the selected Tables
        $selectedTablesSql =
        "SHP_T_BL_HDR, 
        SHP_T_BL_ADDR, 
        SHP_T_BL_ARABIC, 
        SHP_T_BL_BULK_DTL, 
        SHP_T_BL_CLAIMS, 
        SHP_T_BL_CNTR, 
        SHP_T_BL_CNTR_DANG, 
        SHP_T_BL_CORR,
        SHP_T_BL_FRGHT,
        SHP_T_BL_GUARANT,
        SHP_T_BL_INTIM,
        SHP_T_BL_RORO_DTL,
        SHP_T_DET_REMIT_DTL,
        SHP_T_REMIT_DTL,
        SHP_T_VOUCH_HDR,";


        $selectedTablesSqlColumns =
        'SHP_T_BL_CNTR.BL_NUM,
         SHP_T_BL_CNTR.BRN_ID,
         SHP_T_BL_CNTR.CNTR_NUM,
         SHP_T_BL_HDR.BL_NUM,
         SHP_T_BL_HDR.BRN_ID ';


        $sqlText = "SELECT 
                    $selectedTablesSqlColumns
                    FROM $selectedTablesSql
                    WHERE (SHP_T_BL_HDR.BL_NUM = '$blNumber' AND SHP_T_BL_CNTR.BL_NUM = '$blNumber')";
//        print $sqlText;
        $sqlParse = oci_parse( $conn , $sqlText);
        oci_execute($sqlParse);
    }

}



// Close the Oracle connection
//oci_close($conn);
