<?php
include("../resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 py-24 mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold">Notebooks</h1>

        <pre>

		<?php echo route($routes->get('notebooks.show'), 12); ?>
		<?php echo route($routes->get('notebooks.show'), 13); ?>

        </pre>
        <table class="table table-auto">
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
                    <td><a href="<?php echo route($routes->get('notebooks.show'), $n['id']); ?>">View</a></td>
                    <td><a href="<?php echo route($routes->get('notebooks.edit'), $n['id']); ?>">Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<section>

<?php
include("../resources/views/layouts/footer.php");
?>