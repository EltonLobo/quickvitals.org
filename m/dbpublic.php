<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","lobotple_admin","admin1"))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("lobotple_quick"))
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>