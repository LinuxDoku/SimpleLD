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
  public static function connect($db_host, $db_user, $db_pwd, $db_db)
  {
        // connect to server
        $db_connection = mysql_connect($db_host, $db_user, $db_pwd) or die ($lang['db_connection_error']." ".mysql_error());
        // select db
        mysql_select_db($db_db, $db_connection) or die ($lang['db_connection_error']." ".mysql_error());
  }

  /**
   * Run a normal query
   *
   * @param  string $db_sql
   * @return string
   */
  public static function query($db_sql)
  {
        $query_ret = mysql_query($db_sql) or die (mysql_error());
        return $query_ret;
  }

  /**
   * Count all rows, the query will be performed for you
   *
   * @param  string $db_sql
   * @return int
   */
  public static function num_rows($db_sql)
  {
        $rows_ret = mysql_num_rows(self::query($db_sql));
        return $rows_ret;
  }

  /**
   * Fetches all rows into an array
   *
   * @param  string $db_sql
   * @return array
   */
  public static function fetch_array($db_sql)
  {
        $array_ret = mysql_fetch_array($db_sql);
        return $array_ret;
  }
}
?>
