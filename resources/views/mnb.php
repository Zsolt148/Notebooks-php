<?php
include("resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="px-10 mx-auto max-w-7xl">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">
                The Hungarian National Bank currency exchangerates
            </h1>

            <div class="container_data">
	            <h2>Search for exchangees:</h2>

                <div class="wrapper_data">
                    <form action="<?php echo URLROOT; ?>/mnb/GetExchangeRates" method ="POST">
                        <input type="text" placeholder="From currency" name="curr1">
                        <span class="invalidFeedback">
                            <?php echo $data['curr1Error']; ?>
                        </span>
                        
                        <input type="text" placeholder="To currency" name="curr2">
                        <span class="invalidFeedback">
                            <?php echo $data['curr2Error']; ?>
                        </span>

                        <button id="search" type="submit" value="submit">Exchange</button>
                    </form>

                    <span class="invalidFeedback">
                        <?php echo $data['rate1Error']; ?>
                        <?php echo $data['rate2Error']; ?>
                    </span>
                </div>

                <div id="currencies_item">
                    <?php if(!empty($data['curr1'])): ?>
                        <h2>Results:</h2>
                        <table>
                            <tr>
                                <th><?php echo $data['curr1']; ?></th>
                                <th><?php echo $data['curr2']; ?></th>
                            </tr>
                            <tr>
                                <td><?php echo $data['unit1']; ?></td>
                                <td><?php echo $data['rate1']; ?></td>
                            </tr>
                        </table>
                        <br>
                        <h2>Exchange back:</h2>
                        <table>
                            <tr>
                                <th><?php echo $data['curr2']; ?></th>
                                <th><?php echo $data['curr1']; ?></th>
                            </tr>
                            <tr>
                                <td><?php echo $data['unit2']; ?></td>
                                <td><?php echo $data['rate2']; ?></td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <section>

<?php
include("resources/views/layouts/footer.php");
?>