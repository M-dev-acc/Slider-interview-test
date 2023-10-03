<?php

class Database
{   
    /**
     * Database connection object
     * 
     * @var PDO $databaseConnection
     */
    private $databaseConnection = null;

    /**
     * Initialize Database class properties   
     */
    public function __construct() {
        $this->databaseConnection = $this->connect();
    }

    /**
     * Connect to the database
     * 
     * @throws \PDOException
     * @return \PDO
     */
    private function connect() : PDO {
        $servername = "localhost";
        $dbname = "interview_wpoets";
        $username = "root";
        $password = "";
        
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Execute or fetch data using sql query and parameters
     * *using prepare statements
     * 
     * @param string $query
     * @param array $params
     * @return bool|array
     */
    public function executeQuery(string $query, array $params = []): bool|array
    {
        try {
            $db = $this->databaseConnection;
            
            $prepareStatement = $db->prepare($query);

            $status = $prepareStatement->execute($params);
            
            return ($this->isSelectStatement($query)) ? $this->fetchData($prepareStatement) : $status;
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * ------------------------------------------------------------
     * | Helper functions
     * ------------------------------------------------------------
     */

    /**
     * Check given statement is SELECT statement
     * 
     * @param string $query
     * @return bool
     */
    function isSelectStatement(string $query): bool {
        $queryWords = explode(" ", trim($query));
        
        # Tip: The strcasecmp() function is binary-safe and case-insensitive.
        return strcasecmp($queryWords[0], "SELECT") === 0;
    }
    
    /**
     * Fetch data using prepare statements
     * 
     * @param \PDOStatement $statement
     * @return array|object
     */
    function fetchData(PDOStatement $statement){
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
