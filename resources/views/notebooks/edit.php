<?php
include("../resources/views/layouts/header.php");
?>

<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 py-24 mx-auto max-w-7xl">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Edit</h2>

        <form method="POST" action="<?php echo $routes->get('notebooks.update', $notebook['id'])->getPath(); ?>" enctype=”multipart/form-data”>
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700" for="manufacturer">Manufacturer</label>
                    <input id="manufacturer" name="manufacturer" type="text" value="<?php echo $notebook['manufacturer'] ?>" required class="">
                </div>

                <div>
                    <label class="text-gray-700" for="type">Type</label>
                    <input id="type" name="type" type="text" value="<?php echo $notebook['type'] ?>">
                </div>

                <div>
                    <label class="text-gray-700" for="display">Display</label>
                    <input id="display" name="display" type="text" value="<?php echo $notebook['display'] ?>">
                </div>

                <div>
                    <label class="text-gray-700" for="memory">Memory</label>
                    <input id="memory" name="memory" type="text" value="<?php echo $notebook['memory'] ?>">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                    Save
                </button>
            </div>
        </form>
    </div>
</section>
<?php
include("../resources/views/layouts/footer.php");
?>