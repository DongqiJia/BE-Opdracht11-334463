<?php require(APPROOT . '/views/includes/header.php'); ?>

<h3><?= $data['title']; ?></h3>

<h4><?= 'Aantal instructeurs: ' . $data['instructeur']; ?></h4>

<table border='2'>
    <thead>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Mobiel</th>
        <th>Datum in dienst</th>
        <th>Aantal sterren</th>
        <th>Voertuigen</th>
    </thead>

    <tbody>

        <?= $data['rows'] ?>
    </tbody>
</table>

<?php require(APPROOT . '/views/includes/footer.php'); ?>