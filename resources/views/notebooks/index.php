<?php
include("../resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">
            Notebooks - <a class="link" href="<?php echo route($routes->get('notebooks.create')); ?>">Add new</a>
        </h1>

		<?php include_once '../resources/views/shared/status.php' ?>
		<?php include_once '../resources/views/shared/errors.php' ?>

        <div class="overflow-x-scroll">
            <table>
                <tr class="text-left font-bold">
                    <th class="th-class"><span class="th-content">#</span></th>
                    <th class="th-class"><span class="th-content">manufacturer</span></th>
                    <th class="th-class"><span class="th-content">type</span></th>
                    <th class="th-class"><span class="th-content">display</span></th>
                    <th class="th-class"><span class="th-content">memory</span></th>
                    <th class="th-class"><span class="th-content">harddisk</span></th>
                    <th class="th-class"><span class="th-content">videocontroller</span></th>
                    <th class="th-class"><span class="th-content">price</span></th>
                    <th class="th-class"><span class="th-content">processor_id</span></th>
                    <th class="th-class"><span class="th-content">OS name</span></th>
                    <th class="th-class" colspan="3"><span class="th-content">Admin</span></th>
                </tr>
                <tbody>
                <?php foreach($notebooks as $n) { ?>
                    <tr class="tr-class">
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['id']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['manufacturer']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['type']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['display']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['memory']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['harddisk']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['videocontroller']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['price']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['processor_id']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $n['os_name']; ?></span>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('notebooks.show'), $n['id']); ?>">
                                View
                            </a>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('notebooks.edit'), $n['id']); ?>">
                                Edit
                            </a>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('notebooks.delete'), $n['id']); ?>">
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