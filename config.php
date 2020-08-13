<?php

/** O nome do banco de dados*/
define('DB_NAME', 'testebludata');
/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');
/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');
/** nome do host do MySQL */
define('DB_HOST', 'localhost');
/** caminho absoluto para a pasta do sistema **/
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');
/** caminho no server para o sistema **/
if (!defined('BASEURL'))
    define('BASEURL', '/testeBludata/');
/** caminho do arquivo de banco de dados **/
if (!defined('DBAPI'))
    define('DBAPI', ABSPATH . 'ctrl/database.php');
/** caminhos dos templates de header e footer **/  
define('HEADER_TEMPLATE', ABSPATH . 'view/header.php');
define('FOOTER_TEMPLATE', ABSPATH . 'view/footer.php');
