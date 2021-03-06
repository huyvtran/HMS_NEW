<?php


/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");


class OnsitePortalActivityMap implements IDaoMap, IDaoMap2
{

    private static $KM;
    private static $FM;
    
    /**
     * {@inheritdoc}
     */
    public static function AddMap($property, FieldMap $map)
    {
        self::GetFieldMaps();
        self::$FM[$property] = $map;
    }
    
    /**
     * {@inheritdoc}
     */
    public static function SetFetchingStrategy($property, $loadType)
    {
        self::GetKeyMaps();
        self::$KM[$property]->LoadType = $loadType;
    }

    /**
     * {@inheritdoc}
     */
    public static function GetFieldMaps()
    {
        if (self::$FM == null) {
            self::$FM = array();
            self::$FM["Id"] = new FieldMap("Id", "onsite_portal_activity", "id", true, FM_TYPE_BIGINT, 20, null, true);
            self::$FM["Date"] = new FieldMap("Date", "onsite_portal_activity", "date", false, FM_TYPE_DATETIME, null, null, false);
            self::$FM["PatientId"] = new FieldMap("PatientId", "onsite_portal_activity", "patient_id", false, FM_TYPE_BIGINT, 20, null, false);
            self::$FM["Activity"] = new FieldMap("Activity", "onsite_portal_activity", "activity", false, FM_TYPE_VARCHAR, 255, null, false);
            self::$FM["RequireAudit"] = new FieldMap("RequireAudit", "onsite_portal_activity", "require_audit", false, FM_TYPE_TINYINT, 1, "1", false);
            self::$FM["PendingAction"] = new FieldMap("PendingAction", "onsite_portal_activity", "pending_action", false, FM_TYPE_VARCHAR, 255, null, false);
            self::$FM["ActionTaken"] = new FieldMap("ActionTaken", "onsite_portal_activity", "action_taken", false, FM_TYPE_VARCHAR, 255, null, false);
            self::$FM["Status"] = new FieldMap("Status", "onsite_portal_activity", "status", false, FM_TYPE_VARCHAR, 255, null, false);
            self::$FM["Narrative"] = new FieldMap("Narrative", "onsite_portal_activity", "narrative", false, FM_TYPE_LONGTEXT, null, null, false);
            self::$FM["TableAction"] = new FieldMap("TableAction", "onsite_portal_activity", "table_action", false, FM_TYPE_LONGTEXT, null, null, false);
            self::$FM["TableArgs"] = new FieldMap("TableArgs", "onsite_portal_activity", "table_args", false, FM_TYPE_LONGTEXT, null, null, false);
            self::$FM["ActionUser"] = new FieldMap("ActionUser", "onsite_portal_activity", "action_user", false, FM_TYPE_INT, 11, null, false);
            self::$FM["ActionTakenTime"] = new FieldMap("ActionTakenTime", "onsite_portal_activity", "action_taken_time", false, FM_TYPE_DATETIME, null, null, false);
            self::$FM["Checksum"] = new FieldMap("Checksum", "onsite_portal_activity", "checksum", false, FM_TYPE_LONGTEXT, null, null, false);
        }

        return self::$FM;
    }

    /**
     * {@inheritdoc}
     */
    public static function GetKeyMaps()
    {
        if (self::$KM == null) {
            self::$KM = array();
        }

        return self::$KM;
    }
}
