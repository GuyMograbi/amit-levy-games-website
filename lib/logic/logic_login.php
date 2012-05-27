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
                        return $userId;
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
        $cookie['userId'] = $customer->id;
        $cookie['hmac'] = $this->__createUserCookieHmac($customer->id);
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

        $customer = $this->customerDAO->find_by_username($username);
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