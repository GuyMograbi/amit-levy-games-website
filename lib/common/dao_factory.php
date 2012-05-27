
<?php
function dao_getDAO($vo_class)
{
    $conn = new Db($GLOBALS['config']); #get a connection from the pool
    switch ($vo_class)
    {
        case "customer":
            return new CustomerDAO($conn);
        default:
            throw new Exception("unable to find DAO for : [" . $vo_class . "]");
    }
}
?>