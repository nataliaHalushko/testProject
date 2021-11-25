<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calls Report</title>
</head>
<body>
<table>
    <tr>
        <th>Customer ID</th>
        <th>Number of calls within the same continent</th>
        <th>Total Duration of calls within the same continent</th>
        <th>Total number of all calls</th>
        <th>The total duration of all calls</th>
    </tr>
    <?php foreach ($data['report'] as $customerId => $report) { ?>
        <tr>
            <td><?= $customerId ?></td>
            <td><?= $report["sameContinentNumber"] ?></td>
            <td><?= $report["sameContinentDuration"] ?></td>
            <td><?= $report["totalNumber"] ?></td>
            <td><?= $report["totalDuration"] ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>