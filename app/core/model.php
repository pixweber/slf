<?php
namespace SLF\Core;

use PDO;
use App\Config;
use PDOException;

class Model {
    protected $dbh;
    protected $statement;
    protected $error;

    /**
     * Model constructor.
     */
    public function __construct() {
        $db_host = Config::DB_HOST;
        $db_name = Config::DB_NAME;
        $db_user = Config::DB_USER;
        $db_password = Config::DB_PASSWORD;

        $dns = "mysql:host=$db_host;dbname=$db_name";

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO($dns, $db_user, $db_password, $options);
        } catch (PDOException $exception) {
            $this->error = $exception->getMessage();
        }
    }

    /**
     * @param $query
     */
    public function query($query) {
        $this->statement = $this->dbh->prepare($query);
    }

    /**
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = NULL) {
        if (is_null($type)) {
            switch ($value) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->statement->execute();
    }

}