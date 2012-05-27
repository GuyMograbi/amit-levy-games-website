<?php

class CustomerDAO
{
        var $conn;

        function CustomerDAO(&$conn)
        {
            $this->conn = &$conn;
        }

        function findById( $userId )
        {
            $STH = $this->conn->query("select id, username, isAdmin from customer where id = ?", array($userId));
            while ($row = $STH ->fetch())
            {
                return $this->__get_from_result($row);
            }
            return null;
        }

        function findByUsername( $username )
        {
            $STH = $this->conn->query("select id,password, username, isAdmin from customer where username = ?", array($username) );
            while ($row = $STH->fetch())
            {
               return $this->__get_from_result($row);
            }

            echo "couldn't find anything";
            return null;
        }

        # private

        function __get_row_value( $row, $key, $default=null )
        {
           return isset($row[$key]) ? $row[$key] : $default;
        }

        function & __get_from_result( $row )
        {
            $c = new Customer();
            $c->id = $row['id'];
            $c->username = $this->__get_row_value($row,'username');
            $c->password = $this->__get_row_value($row,'password');
            $c->isAdmin = $this->__get_row_value($row,'isAdmin');

            return $c;
        }
}
?>