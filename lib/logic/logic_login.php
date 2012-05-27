<?php

class LoginLogic
{
    var $customerDAO;

    function LoginLogic()
    {
        $this->customerDAO = dao_getDAO("customer");
    }

    function getUserFromCookie( $cookie )
    {
        try
        {
            if (isset($cookie['userId']))
            {
                $userId = $cookie['userId'];
                if (isset($cookie['hmac']))
                {
                    $hmac = $cookie['hmac'];
                    $encrypt = new EncryptDecrypt();

                    if ($this->__createUserCookieHmac( $userId ) == $hmac)
                    {
                        return $this->customerDAO->findById($userId);
                    }
                }

            }
        }
        catch (Exception $e)
        {
        }

        return null;
    }

    function keepUserInCookie( $customer, $cookie )
    {
        $config = common_getConfig();
        setcookie('userId', $customer->id, time()+$config['session_timeout']);
        setcookie('hmac', $this->__createUserCookieHmac($customer->id), time()+$config['session_timeout']);
    }

    function __createUserCookieHmac( $userId )
    {
        $encrypt = new EncryptDecrypt();

        return $encrypt->encrypt($GLOBALS['config']['secret'], $userId);

    }

    function login($username, $password)
    {
        // TODO : add cookie support
        // TODO : need to use HMAC so we will know cookie was not manipulated

        common_getLogger()->LogInfo("searching user [".$username."]");
        $customer = $this->customerDAO->findByUsername($username);
        $encrypt = new EncryptDecrypt();
        if ( $customer == null )
        {
            echo "no such user [".$username."]";

        }
        elseif ( $encrypt->encrypt($password, $password) == $customer->password)
        {
             return $customer;
        }

        echo "user password is : [".$customer->password."] while given password is [". $encrypt->encrypt($password, $password)."]";
        return null;
    }
}
?>