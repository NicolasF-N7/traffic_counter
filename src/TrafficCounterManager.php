<?php

namespace App;

class TrafficCounterManager
{

    public function storeVisit($source): void
    {

        // Store the source (string) into the database table 'traffic_source'
        // The first column is a unique ID, auto-incremented
        $sql = "INSERT INTO traffic_source (unique_id_column, column1) VALUES (:unique_id, :value1)";
        $stmt = $conn->prepare($sql);

        // Set the value to store
        $stmt->bindValue(':value2', $source, PDO::PARAM_STR);

        // Execute te SQL request
        $stmt->execute();

        return;
    }

    public function countTrafficFromSource($source): int
    {
        // Prepare SQL request
        $sql = "SELECT COUNT(*) AS total_count FROM traffic_source WHERE source = :src";
        $stmt = $conn->prepare($sql);

        // Set source data to get
        $stmt->bindValue(':src', $source, PDO::PARAM_STR);

        $stmt->execute();

        // Fetch the count
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            return (int) $result;  // Cast to integer and return
        } else {
            return 0;  // Return 0 if no rows found
        }
    }
}