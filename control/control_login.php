<?php

class LoginController
{
    var $user;
    var $loginLogic;
    function LoginController()
    {
        $this->loginLogic = new LoginLogic();

    }

    function verifyAdminLogin()
    {
        $this->user = $this->__getUserFromCookie();
        if ( $this->user == null || !$this->user->isAdmin )
        {
            $this->__redirectToLogin();
        }
    }

    function verifyUserLogin()
    {
        $this->user = $this->__getUserFromCookie();
        if ( $this->user == null )
        {
            $this->__redirectToLogin();
        }
    }

    function __getUserFromCookie()
    {
        return $this->loginLogic->getUserFromCookie($_COOKIE);
    }

    function __redirectToLogin()
    {
        common_getLogger()->LogInfo("redirecting to login");
       header("Location: /amit/login_form.php");
    }


    function login()
    {

        $username = $_POST['username'];
        $encrypt = new EncryptDecrypt();
        $password = $_POST['password'];
        $encrypt->encrypt($password, $password);
        $this->user = $this->loginLogic->login($username, $password);


        if ($this->user == null)
        {
            common_getLogger()->LogInfo("no such user [".$username."]. redirecting to login");
            $this->__redirectToLogin();
        }
        else
        {
            $this->loginLogic->keepUserInCookie($this->user, $_COOKIE);
            common_getLogger()->LogInfo("user [".$this->user->username.",".true."] logged is");
            if ($this->user->isAdmin)
            {
                common_getLogger()->LogInfo("redirecting to admin index");
                header("Location: /amit/admin_index.php");
            }
            else
            {
                common_getLogger()->LogInfo("redirecting to user index");
                header("Location: /amit/user_index.php");
            }
        }


    }
}

?>