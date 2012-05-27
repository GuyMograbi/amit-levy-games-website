<?php
    require_once 'KLogger.php';
    require_once 'config.php';
    require_once 'db_connection.php';
    require_once 'dao_factory.php';
    require_once 'encrypt_decrypt.php';

    $GLOBALS['logger'] = new KLogger("log.txt",KLogger::INFO);
    $GLOBALS['db_conn'] = new Db($config);

    function common_getLogger(){ return $GLOBALS['logger'];}
    function common_getDbConn(){ return $GLOBALS['db_conn'];}


?>