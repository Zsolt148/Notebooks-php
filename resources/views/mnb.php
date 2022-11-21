<?php
include("../resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="px-10 mx-auto max-w-7xl">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">
                The Hungarian National Bank currency exchangerates
            </h1>
            <h3 class="mb-6 text-2xl font-medium text-center">Search for exchanges:</h3>

            <?php include_once '../resources/views/shared/status.php' ?>
            <?php include_once '../resources/views/shared/errors.php' ?>

            <form action="<?php echo route($routes->get('mnb.post')) ?>" method="POST">
                <input type="text" name="curr1" id="curr1" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Currency from" required>
                <input type="text" name="curr2" id="curr2" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="Currency to" required>
                <div class="block">
                    <button type="submit" class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg" data-primary="blue-600" data-rounded="rounded-lg">Convert</button>
                </div>
            </form>

            <div class="overflow-x-scroll">
                <table>
                    <tr class="text-left font-bold">
                        <th class="th-class"><span class="th-content">Unit</span></th>
                        <th class="th-class"><span class="th-content">Rate</span></th>
                        <th class="th-class"><span class="th-content">Exchange back unit</span></th>
                        <th class="th-class"><span class="th-content">Exchange back rate</span></th>
                    </tr>
                    <tbody>
                    <?php foreach($rates as $rate) { ?>
                        <tr class="tr-class">
                            <td class="td-class">
                                <span class="td-content"><?php echo $rate['unit1']; ?></span>
                            </td>
                            <td class="td-class">
                                <span class="td-content"><?php echo $rate['rate1']; ?></span>
                            </td>
                            <td class="td-class">
                                <span class="td-content"><?php echo $rate['unit2']; ?></span>
                            </td>
                            <td class="td-class">
                                <span class="td-content"><?php echo $rate['rate2']; ?></span>
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