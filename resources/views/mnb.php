<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="px-10 mx-auto max-w-7xl">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">
                The Hungarian National Bank currency exchangerates
            </h1>
            <h3 class="mb-6 text-2xl font-medium text-center">Search for exchanges:</h3>

            <?php include_once APP_ROOT . '/resources/views/shared/status.php' ?>
            <?php include_once APP_ROOT . '/resources/views/shared/errors.php' ?>

            <form action="<?php echo route($routes->get('mnb.post')) ?>" method="POST">
                <input type="text" name="curr1" id="curr1" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Currency from" required>
                <input type="text" name="curr2" id="curr2" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Currency to" required>
                <div class="block">
                    <button type="submit" class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg" data-primary="blue-600" data-rounded="rounded-lg">Convert</button>
                </div>
            </form>
            <?php if(isset($data) && !empty($data)) : ?>
            <div class="overflow-x-scroll">
                <table>
                    <tr class="text-left font-bold">
                        <th class="th-class"><span class="th-content">Currency from</span></th>
                        <th class="th-class"><span class="th-content">Currency to</span></th>
                    </tr>
                    <tbody>
                        <tr class="tr-class">
                            <td class="td-class">
                                <span class="td-content"><?php echo $data['unit1'] . " " . $data['curr1']; ?></span>
                            </td>
                            <td class="td-class">
                                <span class="td-content"><?php echo $data['rate1'] . " " . $data['curr2']; ?></span>
                            </td>
                        </tr>
                        <tr class="tr-class">
                            <td class="td-class">
                                <span class="td-content"><?php echo $data['unit2'] . " " . $data['curr2']; ?></span>
                            </td>
                            <td class="td-class">
                                <span class="td-content"><?php echo $data['rate2'] . " " . $data['curr1']; ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    <section>
        
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>