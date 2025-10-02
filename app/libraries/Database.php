<?php
/**
 * Dit is de database class die alle communicatie met de database verzorgt
 */

class Database
{
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;

    private $dbHandler;
    private $statement;

    public function __construct()
    {
        // Connectiestring voor PDO
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            echo "Op dit moment kunnen we u niet helpen... probeer het later nog eens";
            header('Refresh:30; url=' . URLROOT . '/homepages/index');
            exit;
        }
    }

    // Bereidt een SQL query voor
    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    // Voert query uit en haalt meerdere resultaten op
    public function resultSet()
    {
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Voert query uit en haalt één resultaat op
    public function single()
    {
        $this->statement->execute();
        $result = $this->statement->fetch(PDO::FETCH_OBJ);
        $this->statement->closeCursor();
        return $result;
    }

    // Bind een parameter aan de query met automatisch type-detectie
    public function bind($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            if (is_int($value)) {
                $type = PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = PDO::PARAM_BOOL;
            } elseif (is_null($value)) {
                $type = PDO::PARAM_NULL;
            } else {
                $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    // Voer query uit
    public function execute()
    {
        return $this->statement->execute();
    }

    // Voer een directe query uit zonder bind
    public function outQuery($sql)
    {
        return $this->dbHandler->query($sql);
    }
}
