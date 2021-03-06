<?php

class Controller_alerts extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    function _action_listactmgr()
    {
        $c = new CdrAlertManager();
        // Instantiating object if does not exist to avoid
        //    "creating default object from empty value" warning.
        if (!isset($this->viewBean)) {
                $this->viewBean = new stdClass();
        }

        $this->viewBean->rules = $c->populate();
        $this->set_view("list_actmgr.php");
    }

    
    function _action_submitactmgr()
    {

        
        $ids = $_POST["id"];
        $actives = $_POST["active"];
        $passives =  $_POST["passive"];
        $reminders =  $_POST["reminder"];
                $access_controls = $_POST["access_control"];
        
            
        // The array of check-boxes we get from the POST are only those of the checked ones with value 'on'.
        // So, we have to manually create the entitre arrays with right values.
        $actives_final = array();
        $passives_final = array();
        $reminders_final = array();

            
        $numrows = count($ids);
        for ($i = 0; $i < $numrows; ++$i) {
            if ($actives[$i] == "on") {
                $actives_final[] = "1";
            } else {
                $actives_final[] = "0";
                ;
            }
                
            if ($passives[$i] == "on") {
                $passives_final[] = "1";
            } else {
                $passives_final[] = "0";
                ;
            }
                
            if ($reminders[$i] == "on") {
                $reminders_final[] = "1";
            } else {
                $reminders_final[] = "0";
                ;
            }
        }

        // Reflect the changes to the database.
         $c = new CdrAlertManager();
         $c->update($ids, $actives_final, $passives_final, $reminders_final, $access_controls);
         // Instantiating object if does not exist to avoid
         //    "creating default object from empty value" warning.
        if (!isset($this->viewBean)) {
              $this->viewBean = new stdClass();
        }

         $this->forward("listactmgr");
    }
}
