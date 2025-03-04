<?php
// Include the CRUD operations file
require 'crud.php';

// Fetch all employees, documents, and clients
$employees = getEmployees();
$documents = getDocuments();
$clients = getClients();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Employe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <h1>Gestion Employés</h1>
    <div id="employee-form">
        <h2>Ajouter/Modifier Employee</h2>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id" id="id" value="">
            <label for="nom">Nom:</label>
            <input type="text" id="name" name="nom" required>
            <label for="poste">Poste:</label>
            <input type="text" id="position" name="poste" required>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div id="employee-list">
        <h2>Liste des employes</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="employees">
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['nom'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($employee['poste'] ?? ''); ?></td>
                        <td>
                            <a href="crud.php?edit=<?php echo $employee['id']; ?>">Edit</a>
                            <a href="crud.php?delete=<?php echo $employee['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h1>Gestion Documents</h1>
    <div id="document-form">
        <h2>Ajouter/Modifier Document</h2>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id" id="id" value="">
            <label for="title">Titre:</label>
            <input type="text" id="title" name="title" required>
            <label for="content">Description:</label>
            <textarea id="content" name="content" required></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div id="document-list">
        <h2>Liste des Documents</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="documents">
                <?php foreach ($documents as $document): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($document['titre'] ?? ''); ?></td>
                        <td>
                            <a href="crud.php?edit=<?php echo $document['id']; ?>">Edit</a>
                            <a href="crud.php?delete=<?php echo $document['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h1>Gestion Clients</h1>
    <div id="client-form">
        <h2>Ajouter/Modifier Client</h2>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id" id="id" value="">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Contact:</label>
            <input type="text" id="email" name="email" required>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div id="client-list">
        <h2>Client List</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="clients">
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['nom'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($client['contact'] ?? ''); ?></td>
                        <td>
                            <a href="crud.php?edit=<?php echo $client['id']; ?>">Edit</a>
                            <a href="crud.php?delete=<?php echo $client['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</body>
<script src="index.js"></script>
</html>