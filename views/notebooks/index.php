<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Homepage - notebooks</h1>

        <table>
            <thead>
            <tr>
                <td>#</td>
                <td>manufacturer</td>
                <td>type</td>
                <td>display</td>
                <td>memory</td>
                <td>harddisk</td>
                <td>videocontroller</td>
                <td>price</td>
                <td>processor_id</td>
                <td>opsystem_id</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($notebooks as $n) { ?>
                <tr>
                    <td><?php $n['id'] ?></td>
                    <td><?php $n['manufacturer'] ?></td>
                    <td><?php $n['type'] ?></td>
                    <td><?php $n['display'] ?></td>
                    <td><?php $n['memory'] ?></td>
                    <td><?php $n['harddisk'] ?></td>
                    <td><?php $n['videocontroller'] ?></td>
                    <td><?php $n['price'] ?></td>
                    <td><?php $n['processor_id'] ?></td>
                    <td><?php $n['opsystem_id'] ?></td>
                    <td><a href="<?php str_replace('{id}', $n['id'], $route)?>">View</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <section>
</body>
</html>