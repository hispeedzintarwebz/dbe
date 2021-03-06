<?php

class menu {
    private $dbe, $action;

    /*////////////////////////////////////////////////////////       LIST		//////////////////////////////////////////////////*/
    function __construct($dbe, $action)
    {

        $this -> dbe = $dbe;
        $this -> action = $action;
        $this -> ShowUserPanel();
        $this -> ShowDatabases();
        $this -> ShowTables();
        $this -> ShowActions();
    }

    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

    /*////////////////////////////////////////////       SHOW DATABASES	////////////////////////////////////////////////////////////*/
    function ShowDatabases()
    {
        if ($this -> dbe -> dblist != $empty) {

            echo "<div><fieldset><div class='heading'>Databases</div><p class='cloud'>";
            foreach ($this->dbe->dblist as $i => $dbase) {

                if ($this -> dbe -> db != $dbase)
                    echo " <a href='" . $_SERVER['PHP_SELF'] . "?db=" . $i . "'>" . $dbase -> name . "</a> ";
                else
                    echo " " . $dbase -> name . " ";
            }

            echo "</p></fieldset></div>";
        }
    }

    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

    /*////////////////////////////////////////////       SHOW TABLES	////////////////////////////////////////////////////////////*/
    function ShowTables()
    {
        if (count($this -> dbe -> db -> tablelist) > 0) {

            echo "<div><fieldset><div class='heading'>Tables in " . $this -> dbe -> db -> name . "</div><p class='cloud'>";

            foreach ($this->dbe->db->tablelist as $i => $t) {

                if ($t != $this -> dbe -> db -> table)
                    echo " <a href='" . $_SERVER['PHP_SELF'] . "?db=" . $this -> dbe -> db -> index . "&amp;table=" . $i . "'>" . $t -> name . "</a> ";
                else
                    echo " " . $t -> name . " ";
            }

            echo "</p></fieldset></div>";
        }
    }

    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

    /*////////////////////////////////////////////       SHOW VIEWS		////////////////////////////////////////////////////////////*/
    function ShowViews()
    {
        //TODO:Implement
    }

    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

    /*////////////////////////////////////////////       SHOW ACTIONS	////////////////////////////////////////////////////////////*/
    public function ShowActions()
    {
        echo "<div><fieldset><div class='heading'>Actions</div><p class='cloud'>";

        $actions = explode(',', ACTIONS);
        $action_names = array();
        $action_codes = array();

        foreach ($actions as $action) {
            $act = explode('->', $action);
            array_push($action_names, $act[1]);
            array_push($action_codes, $act[0]);
        }

        foreach ($action_names as $i => $action) {
            if ($this -> action != $action_codes[$i])
                echo " <a href='./?action=" . $action_codes[$i] . "&amp;db=" . $this -> dbe -> db -> index . "&amp;table=" . $this -> dbe -> db -> table -> index . "'>" . $action . "</a> ";
            else
                echo " " . $action . " ";

        }
        echo "</p></fieldset></div>";
    }

    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
    /*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

    public function ShowUserPanel()
    {

        echo "<div><fieldset>
			
			<div class='heading'>Connection Info</div><form name='logout' action='index.php' method='post'>
			<input type='hidden' name='logout' value='1'/><span>Logged in as " . $_SESSION['dbuser'] . "</span>
			<span>Engine: " . $_SESSION['engine'] . " </span>
			<span><input type='submit' name='logout' value='Log Out'/></span>
			</form></fieldset></div>";
    }

}
?>
