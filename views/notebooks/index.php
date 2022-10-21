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
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($notebooks as $n) { ?>
                <tr>
                    <td><?php echo $n['id']; ?></td>
                    <td><?php echo $n['manufacturer']; ?></td>
                    <td><?php echo $n['type']; ?></td>
                    <td><?php echo $n['display']; ?></td>
                    <td><?php echo $n['memory']; ?></td>
                    <td><?php echo $n['harddisk']; ?></td>
                    <td><?php echo $n['videocontroller']; ?></td>
                    <td><?php echo $n['price']; ?></td>
                    <td><?php echo $n['processor_id']; ?></td>
                    <td><?php echo $n['opsystem_id']; ?></td>
                    <td><a href="<?php echo str_replace('{id}', $n['id'], $show);?>">View</a></td>
                    <td><a href="<?php echo str_replace('{id}', $n['id'], $edit);?>">Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <section>
</body>
</html>