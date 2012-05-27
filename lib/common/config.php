<?php

    global $config;

    function get_config()
    {
        $log = new KLogger("bootstrap.txt",KLogger::INFO);

        if ( $GLOBALS['config'] == null )
        {
            // this will happen every time!!!
            $string = file_get_contents("lib/conf.json");
            $config=json_decode($string,true);
            if ($config == null)
            {
                switch (json_last_error())
                {
                    case JSON_ERROR_DEPTH:
                        $error = ' - Maximum stack depth exceeded';
                        break;
                    case JSON_ERROR_CTRL_CHAR:
                        $error = ' - Unexpected control character found';
                        break;
                    case JSON_ERROR_SYNTAX:
                        $error = ' - Syntax error, malformed JSON';
                        break;
                    case JSON_ERROR_NONE:
                    default:
                        $error = '';
                }
                throw new Exception("unable to load configuration. problem was : [" .$error."]");
            }
            $GLOBALS['config'] = $config;
        }

        return $GLOBALS['config'];
    }

    get_config();


?>