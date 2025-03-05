<?php
// require 'auth.php';

// if (!isAuthenticated()) {
//     header("Location: login.php");
//     exit();
// }

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
                    <th>Titre</th>
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

    <h1>Gestion des Fichier FTP</h1>
    <div id="ftp-upload-form">
        <h2>Televerser un fichier</h2>
        <form action="crud.php" method="POST" enctype="multipart/form-data">
            <label for="file_upload">Choisi un fichier:</label>
            <input type="file" id="file_upload" name="file_upload" required>
            <button type="submit">Upload</button>
        </form>
    </div>

    <div id="ftp-file-list">
        <h2>Fichiers sur le serveur FTP</h2>
        <ul>
            <?php
            $ftp_config = include 'ftp_config.php';

            echo $ftp_config['ftp_server'];

            // Establish FTP connection
            $ftp_conn = ftp_connect($ftp_config['ftp_server']) or die("Could not connect to " + $ftp_config['ftp_server']);
            $login = ftp_login($ftp_conn, $ftp_config['ftp_user'], $ftp_config['ftp_pass']);

            if ($login) {
                // Get list of files
                $file_list = ftp_nlist($ftp_conn, $ftp_config['ftp_root']);

                if ($file_list) {
                    foreach ($file_list as $file) {
                        $file_name = basename($file);
                        echo "<li>
                                $file_name
                                <a href='crud.php?download=$file_name'>Télécharger</a>
                                <a href='crud.php?delete_file=$file_name' onclick=\"return confirm('Vous êtes sûr?')\">Supprimer</a>
                              </li>";
                    }
                } else {
                    echo "<li>Aucun fichier trouvé.</li>";
                }
            } else {
                echo "<li>Échec de la connexion FTP.</li>";
            }

            // Close the FTP connection
            ftp_close($ftp_conn);
            ?>
        </ul>
    </div>
    
</body>
<script src="index.js"></script>
</html>