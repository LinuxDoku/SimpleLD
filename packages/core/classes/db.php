<?php
/**
 * This class provides all database functions
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class db
{
  /**
   * Connect to database
   * 
   * @param  string $db_host
   * @param  string $db_user
   * @param  string $db_pwd
   * @param  string $db_db
   */
  public static function connect($db_host, $db_user, $db_pwd, $db_db)
  {
        // connect to server
        $db_connection = mysql_connect($db_host, $db_user, $db_pwd) or die (mysql_error());
        // select db
        mysql_select_db($db_db, $db_connection) or die (mysql_error());
  }

  /**
   * Run a normal query
   *
   * @param  string $sql
   * @return string
   */
  public static function query($sql)
  {
        $query = mysql_query($sql) or die (mysql_error());
        return $query;
  }

  /**
   * Count all rows of the result
   *
   * @param  string $sql
   * @return int
   */
  public static function num_rows($sql)
  {
        $rows = mysql_num_rows($sql);
        return $rows;
  }

  /**
   * Fetches all rows into an array
   *
   * @param  string $sql
   * @return array
   */
  public static function fetch_array($sql)
  {
        $array = mysql_fetch_array($sql);
        return $array;
  }
}
?>
