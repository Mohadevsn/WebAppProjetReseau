<?php
// Database connection
$host = 'localhost';
$dbname = 'rxProjetDb';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to get all employees
function getEmployees() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM employees");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get all documents
function getDocuments() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM documents");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get all clients
function getClients() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM clients");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add or update an employee
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $poste = $_POST['poste'];

    if ($id) {
        // Update employee
        $stmt = $pdo->prepare("UPDATE employees SET nom = ?, poste = ? WHERE id = ?");
        $stmt->execute([$nom, $poste, $id]);
    } else {
        // Add new employee
        $stmt = $pdo->prepare("INSERT INTO employees (nom, poste) VALUES (?, ?)");
        $stmt->execute([$nom, $poste]);
    }

    header("Location: index.php");
    exit();
}

// Function to add or update a document
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($id) {
        // Update document
        $stmt = $pdo->prepare("UPDATE documents SET titre = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $content, $id]);
    } else {
        // Add new document
        $stmt = $pdo->prepare("INSERT INTO documents (titre, description) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
    }

    header("Location: index.php");
    exit();
}

// Function to add or update a client
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    if ($id) {
        // Update client
        $stmt = $pdo->prepare("UPDATE clients SET name = ?, contact = ? WHERE id = ?");
        $stmt->execute([$name, $contact, $id]);
    } else {
        // Add new client
        $stmt = $pdo->prepare("INSERT INTO clients (name, contact) VALUES (?, ?)");
        $stmt->execute([$name, $contact]);
    }

    header("Location: index.php");
    exit();
}

// Function to delete an employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
}

// Function to delete a document
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM documents WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
}

// Function to delete a client
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
}

// Function to fetch an employee for editing
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->execute([$id]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee) {
        echo json_encode($employee);
        exit();
    }
}

// Function to fetch a document for editing
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
    $stmt->execute([$id]);
    $document = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($document) {
        echo json_encode($document);
        exit();
    }
}

// Function to fetch a client for editing
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($client) {
        echo json_encode($client);
        exit();
    }
}

?>