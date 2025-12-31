<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Application Covoiturage</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h2 { margin-top: 40px; }
        a { text-decoration: none; color: blue; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>Application Covoiturage</h1>

<?php if (isset($users) && count($users) > 0): ?>
    <h2>Utilisateurs</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= htmlspecialchars($user->lastname) ?></td>
                <td><?= htmlspecialchars($user->firstname) ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td><?= htmlspecialchars($user->phone) ?></td>
                <td><?= $user->role ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php if (isset($agencies) && count($agencies) > 0): ?>
    <h2>Agences</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
        </tr>
        <?php foreach($agencies as $agency): ?>
            <tr>
                <td><?= $agency->id ?></td>
                <td><?= htmlspecialchars($agency->name) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php if (isset($trips) && count($trips) > 0): ?>
    <h2>Trajets</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date & Heure Départ</th>
            <th>Date & Heure Arrivée</th>
            <th>Places Totales</th>
            <th>Places Disponibles</th>
            <th>Conducteur</th>
        </tr>
        <?php foreach($trips as $trip): ?>
            <tr>
                <td><?= $trip->id ?></td>
                <td><?= htmlspecialchars($trip->departure_agency) ?></td>
                <td><?= htmlspecialchars($trip->arrival_agency) ?></td>
                <td><?= $trip->departure_datetime ?></td>
                <td><?= $trip->arrival_datetime ?></td>
                <td><?= $trip->total_seats ?></td>
                <td><?= $trip->available_seats ?></td>
                <td><?= htmlspecialchars($trip->firstname . ' ' . $trip->lastname) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>

