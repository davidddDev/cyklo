<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Výsledky ročníku</title>

    <link rel="stylesheet" href="<?= base_url('node_modules/flag-icons/css/flag-icons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" />
    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <style>
        body {
            background-color: #10141a;
            color: #e0e0e0; /* základní barva textu - světle šedá */
            font-family: "Segoe UI", sans-serif;
        }
        table {
            width: 100%;
            background-color: #1b1f27;
            border-collapse: collapse;
            color: #fff; /* bílý text v tabulce */
        }
        thead {
            background-color: #242a35;
        }
        thead th {
            color: #a0c8ff;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #3c3f47;
            text-align: left;
        }
        tbody tr:nth-child(odd) {
            background-color: #1e232d;
        }
        tbody tr:nth-child(even) {
            background-color: #272d39;
        }
        tbody td {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #2d323c;
            color: #e8f0ff;
        }
        a {
            color: #8ecbff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: #8ecbff;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        h1 {
            margin-bottom: 1.5rem;
            color: #fff;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container mt-4">

    <h1>Výsledky ročníku: <?= esc($year->default_name) ?> – <?= esc($year->real_name) ?></h1>
    <p><?= esc($year->start_date) ?> – <?= esc($year->end_date) ?></p>

    <?php if (!empty($results)): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jezdec</th>
                    <th>Tým</th>
                    <th>Čas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?= esc($result->rank) ?></td>
                        <td><?= esc($result->rider_name ?? '-') ?></td>
                        <td><?= esc($result->team_name ?? '-') ?></td>
                        <td><?= esc($result->time) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Výsledky nejsou k dispozici.</p>
    <?php endif; ?>

    <a href="<?= base_url() ?>" class="back-link">← Zpět na přehled</a>

</div>
</body>
</html>
