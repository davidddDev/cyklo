<!-- index.php -->
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite závody</title>
    
    <link rel="stylesheet" href="<?= base_url('node_modules/flag-icons/css/flag-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url("node_modules/bootstrap/dist/css/bootstrap.min.css") ?>">
    <script src="<?= base_url("node_modules/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>

    <style>
        body {
            background-color: #10141a;
            color: #e0e0e0;
            font-family: "Segoe UI", sans-serif;
        }
        .card {
            background-color: #1b1f27;
            border: 1px solid #2d323c;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        .card-header {
            background-color: #242a35;
            color: #fff;
            border-bottom: 1px solid #3c3f47;
            font-size: 1.2rem;
        }
        .table {
            background-color: #1e232d;
        }
        .table thead {
            background-color: #2d333f;
        }
        .table th {
            color: #a0c8ff;
        }
        .table-results {
            background-color: #272d39;
            margin-top: 0.5rem;
        }
        a {
            color: #8ecbff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container mt-4"> 

    <h1 class="mb-4">Elite zavody muzu</h1> 

    <!-- cyklus pres zavody -->
    <?php foreach ($races as $race): ?>
        <div class="card">
            <div class="card-header">
                <!-- pokud ma zavod zemi, zobrazime vlajku -->
                <?php if (!empty($race->info->country)): ?>
                    <!-- pouzivame kod zeme pro flag-icons, prevede se na mala pismena -->
                    <span class="fi fi-<?= strtolower(esc($race->info->country)) ?>"></span>&nbsp;
                <?php endif; ?>
                <!-- zobrazime nazev zavodu -->
                <?= esc($race->info->default_name) ?>
            </div>
            <div class="card-body">
                <!-- tabulka rocniku daneho zavodu -->
                <table class="table table-sm table-dark table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Rocnik</th>
                            <th>Datum</th>
                            <th>UCI Tour</th>
                            <th>Top 20 vysledku</th>
                        </tr>
                    </thead>
<tbody>
<!-- cyklus pres vsechny rocniky tohoto zavodu -->
<?php foreach ($race->years as $year): ?>
    <tr>
        <!-- klikatelny odkaz na stranku s vysledky pro dany rocnik -->
        <td>
            <a href="<?= base_url('rocnik/' . $year->id) ?>">
                <?= esc($year->real_name) ?>
            </a>
        </td>

        <!-- datum zacatku a konce -->
        <td><?= esc($year->start_date) ?> – <?= esc($year->end_date) ?></td>

        <!-- UCI tour nebo pomlcka -->
        <td><?= esc($year->uci_tour_name ?? '-') ?></td>

        <!-- misto tabulky vysledku jen text s odkazem -->
        <td>
            <a href="<?= base_url('rocnik/' . $year->id) ?>">Zobrazit vysledky</a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>


</div>
</body>
</html>
