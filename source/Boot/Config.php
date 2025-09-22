<?php

/**
 * DATABASE
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "db_bugdet");

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.orcafacil.com.br");
define("CONF_URL_TEST", "http://localhost/OrcaFacil");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");

/**
 * MESSAGE
 */

define("CONF_MESSAGE_ERROR", "");
define("CONF_MESSAGE_WARNING", "");
define("CONF_MESSAGE_SUCCESS", "");
define("CONF_MESSAGE_BUTTON", "");
define("CONF_MESSAGE_LOAD", "");

/**
 * VIEW
*/
define("CONF_VIEW_PATH", __DIR__ . "/../../themes");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "orcaweb");
define("CONF_VIEW_APP", "orcaapp");

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "mail.syscerberus.com");
define("CONF_MAIL_PORT", "465");
define("CONF_MAIL_USER", "testeemail@syscerberus.com");
define("CONF_MAIL_PASS","1900@@25081900");
define("CONF_MAIL_SENDER", ["name" => "Orça Fácil", "address" => "testeemail@syscerberus.com"]);
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_CHARSET", "utf-8");