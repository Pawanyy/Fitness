<?php 
// This manages Database Connection For PDO and Mysqli Connection
class Database{

    private ?mysqli $conn1 = null;
    private ?PDO $conn2 = null;
    private string $host;
    private string $name;
    private string $user;
    private string $password;

    // Assign Database Credentials
    public function __construct( string $host, string $name, string $user, string $password){
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    // Generate a Mysqli Connection if Mysqli_Connection is null
    public function getConnectionMysqli():mysqli{

        if($this->conn1 === null){

            $this->conn1 = new mysqli($this->host, $this->user, $this->password, $this->name);

            if ($this->conn1 -> connect_errno) {
                echo $$this->conn1 -> connect_error;
            };
        }

        return $this->conn1;
    }

    // Generate a PDO Connection if PDO_Connection is null
    public function getConnectionPDO():PDO{

        if($this->conn2 === null){

            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

            try {
                $this->conn2 = new PDO($dsn, $this->user, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_STRINGIFY_FETCHES => false
                ]);
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        return $this->conn2;
    }

}
?>