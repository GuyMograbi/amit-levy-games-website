<?php
    require_once "require_all.php";

    class Db
    {
        var $host, $username, $password, $dbname, $dbh;



        function Db(&$config)
        {
           $this->username = $config['db_username'];
           $this->host = $config['db_host'];
           $this->password = $config['db_password'];
           $this->dbname = $config['db_name'];
        }

        function checkErrors()
        {
            if ( sizeof($this->dbh->errorInfo()) > 0)
            {
                $errors = $this->dbh->errorInfo();
//                echo $errors[0];
            }
        }


        function query( $query, $params = null )
        {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $stmt = $dbh->prepare($query);
            $stmt->execute($params);

            return $stmt;



//            echo "<br/>";
//            if ($this->dbh == null)
//            {
//                $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
//            }
//
//           $stmt = $this->dbh->prepare( $query );
//           if ( $params != null )
//           {
//               foreach($params as $key => $value )
//               {
//                   $stmt->bindValue(":".$key, $value, PDO::PARAM_STR);
//                   echo ":".$key."=>".$value."<br/>";
//               }
//           }
//            echo "<br/>";
////            $stmt->debugDumpParams();
//
//            echo "<br/>";
//
////            $stmt->fetch();
////            echo $stmt->columnCount();
//
//
//
//            if ( $stmt ->errorCode())
//            {
//
//            }
//
//            return $stmt;
        }

    }
?>