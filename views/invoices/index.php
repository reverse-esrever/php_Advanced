<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td>description</td>
                <td>status</td>
            </tr>
            <?php

 foreach($invoices as $invoice): ?>
                <tr>
                    <td><?php echo $invoice['description'] ?></td>
                    <td><?php echo \App\Examples\Enum\Status::tryFrom($invoice['status'])->toString() ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>