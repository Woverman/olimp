<?
define('ARRAY_A', 'ARRAY_A', false);
define('ARRAY_N', 'ARRAY_N', false);
class DB
{

    var $dbh;
    var $rows = 0;
    var $last_result = NULL;
    var $last_query = NULL;

    var $dbuserLink;
    var $dbpasswordLink;
    var $dbnameLink;
    var $dbhostLink;

    function DB($dbuser, $dbpassword, $dbname, $dbhost)
    {
        return $this->__construct($dbuser, $dbpassword, $dbname, $dbhost);
    }

    function __construct($dbuser, $dbpassword, $dbname, $dbhost)
    {
        $this->dbuserLink = $dbuser;
        $this->dbpasswordLink = $dbpassword;
        $this->dbnameLink = $dbname;
        $this->dbhostLink = $dbhost;

        $this->dbh = mysql_connect($dbhost, $dbuser, $dbpassword, true);
        mysql_select_db($dbname);
        mysql_query('set names utf8');
    }

    function insert($sql)
    {
        mysql_unbuffered_query($sql, $this->dbh);
        $insert_id = mysql_insert_id($this->dbh);
        $rows = mysql_affected_rows($this->dbh);
        mysql_unbuffered_query("insert into as_log (request) values ('" . (addslashes($sql)) . "')", $this->dbh);
        return $insert_id;

    }

    function request($sql, $output = ARRAY_N)
    {
        mysql_unbuffered_query("insert into as_log (request) values ('" . (addslashes($sql)) . "')", $this->dbh);
        if ($sql != $this->last_query) {
            $this->last_query = $sql;
            $result = mysql_query($sql, $this->dbh);
            unset($this->last_result);
            if ($result) {
                $this->rows = 0;
                while ($row = mysql_fetch_object($result)) {
                    $this->last_result[$this->rows] = $row;
                    $this->rows++;
                }
            }
        }
        $i = 0;
        foreach ((array)$this->last_result as $row) {
            if ($output == ARRAY_N) {
                // ...integer-keyed row arrays
                $new_array[$i] = array_values(get_object_vars($row));
            } else {
                // ...column name-keyed row arrays
                $new_array[$i] = get_object_vars($row);
            }
            ++$i;
        }
        return $new_array;
    }

    function LoadDictionary($dictName)
    {
        $tmp_arr = array();
        $sql = "SELECT id,title from " . $dictName;
        $res = $this->request($sql, ARRAY_A);
        if ($res) {
            foreach ($res as $key => $value) {
                $tmp_arr[$value['title']] = $value['id'];
            }
        }
        return $tmp_arr;
    }

    function appendDictionary($dictName, $item)
    {
        $sql = "insert into " . $dictName . " (title) values ('" . $item . "')";
        $this->insert($sql);
        return mysql_insert_id($this->dbh);
    }

    function callSP($sql)
    {
        $tmpArray = array();

        $mysqli = new mysqli($this->dbhostLink, $this->dbuserLink, $this->dbpasswordLink, $this->dbnameLink);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("<br />Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        /* Call my stored procedure the first time */
        if ($mysqli->multi_query($sql)) {
            $index = 0;
            do {
                /* store first result set */
                if ($result = $mysqli->store_result()) {
                    while ($row = $result->fetch_row()) {
                        $tmpArray[$index] = $row;
                        $index++;
                    }
                    $result->close();
                }
                /* print divider */
                if ($mysqli->more_results()) {
                }
            } while ($mysqli->next_result());
        }
        else {
            printf("<br />First Error: %s\n", $mysqli->error);
        }
        $mysqli->close();

        return $tmpArray;
    }
}

if (!isset($DB)) {
    $DB = new DB($dbuser[$sqlserver], $dbpass[$sqlserver], $dbname[$sqlserver], $dbhost[$sqlserver]);
}


?>