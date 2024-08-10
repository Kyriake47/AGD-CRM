<?php
    class DatabaseHandler {
        protected $conn;

        public function __construct($dbConnection) {
            $this->conn = $dbConnection;
        }

        protected function executeQuery($query, $types, $params) {
            $stmt = $this->conn->prepare($query);

            if ($stmt == false) {
                throw new Exception("Prepare failed: " . htmlspecialchars($this->conn->error));
            }

            $stmt->bind_param($types, ...$params);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . htmlspecialchars($stmt->error));
            }

            $stmt->close();
        }

        protected function fetchResults($query, $types = null, $params = []) {
            $stmt = $this->conn->prepare($query);
    
            if ($stmt == false) {
                throw new Exception("Prepare failed: " . htmlspecialchars($this->conn->error));
            }
    
            if ($types && $params) {
                $stmt->bind_param($types, ...$params);
            }
    
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . htmlspecialchars($stmt->error));
            }
    
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
    
            return $data;
        }
    }
?>