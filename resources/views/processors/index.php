<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">
            Processors
            <?php if(auth()->check()) : ?>
                - <a class="button" href="<?php echo route($routes->get('processors.create')); ?>">Add new</a>
			<?php endif; ?>
        </h1>

		<?php include_once APP_ROOT . '/resources/views/shared/status.php' ?>
		<?php include_once APP_ROOT . '/resources/views/shared/errors.php' ?>

        <div class="overflow-x-scroll">
            <table>
                <tr class="text-left font-bold">
                    <th class="th-class"><span class="th-content">#</span></th>
                    <th class="th-class"><span class="th-content">manufacturer</span></th>
                    <th class="th-class"><span class="th-content">type</span></th>
                    <th class="th-class" colspan="3"><span class="th-content">Admin</span></th>
                </tr>
                <tbody>
                <?php foreach($processors as $pro) { ?>
                    <tr class="tr-class">
                        <td class="td-class">
                            <span class="td-content"><?php echo $pro['id']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $pro['manufacturer']; ?></span>
                        </td>
                        <td class="td-class">
                            <span class="td-content"><?php echo $pro['type']; ?></span>
                        </td>
                        <td class="td-class">
                            <a class="td-content link" href="<?php echo route($routes->get('processors.show'), $pro['id']); ?>">
                                View
                            </a>
                        </td>
						<?php if(auth()->check()) : ?>
                            <td class="td-class">
                                <a class="td-content link" href="<?php echo route($routes->get('processors.edit'), $pro['id']); ?>">
                                    Edit
                                </a>
                            </td>
                            <td class="td-class">
                                <a class="td-content link" href="<?php echo route($routes->get('processors.delete'), $pro['id']); ?>">
                                    Delete
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <section>

<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>