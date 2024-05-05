<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    include("../frontend/conf.php");    

    function sanitizeInput($data) {
        // Your input sanitization code here
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $firstname = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $subject = sanitizeInput($_POST["subject"]);
    $message = sanitizeInput($_POST["message"]);

$stmt = $conn->prepare("INSERT INTO feeds (Name, Email,Subject, Message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $email, $subject, $message);

            if ($stmt->execute()) {
                header("Location: index.php");
                $response = array("success" => true, "message" => "User registered successfully");
            } else {
                header("Location: register.php");
                $response = array("success" => false, "message" => "Error registering user: " . $stmt->error);
            }
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        // Return JSON response
        echo json_encode($response);
    
    exit();

?>