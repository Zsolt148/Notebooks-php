<?php
include("../resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold">Notebooks</h1>

		<?php if(isset($_GET['status']) && !empty($_GET['status'])) { ?>
            <div class="relative items-center w-full py-12 mx-auto">
                <div class="p-6 border-l-4 border-green-500 -6 rounded-r-xl bg-green-50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm text-green-700">
                                <p><?php echo $_GET['status']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>

        <?php if(isset($errors) && !empty($errors)) { ?>

		<?php } ?>

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
                    <td><a href="<?php echo route($routes->get('notebooks.delete'), $n['id']); ?>">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<section>

<?php
include("../resources/views/layouts/footer.php");
?>