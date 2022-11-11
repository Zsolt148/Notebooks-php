<?php
include("../resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">
            Opsystems - <a class="link" href="<?php echo route($routes->get('opsystems.create')); ?>">Add new</a>
        </h1>

		<?php include_once '../resources/views/shared/status.php' ?>
		<?php include_once '../resources/views/shared/errors.php' ?>

        <div class="overflow-x-scroll">
            <table>
                <tr class="text-left font-bold">
                    <th class="th-class"><span class="th-content">#</span></th>
                    <th class="th-class"><span class="th-content">OS. name</span></th>
                    <th class="th-class" colspan="3"><span class="th-content">Admin</span></th>
                </tr>
                <tbody>
                <?php foreach($opsystems as $op) { ?>
                    <tr class="tr-class">
                        <td class="td-class">
                            <span class="td-content"><?php echo $op['id']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $op['os_name']; ?></span>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('opsystems.show'), $op['id']); ?>">
                                View
                            </a>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('opsystems.edit'), $op['id']); ?>">
                                Edit
                            </a>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('opsystems.delete'), $op['id']); ?>">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <section>

<?php
include("../resources/views/layouts/footer.php");
?>