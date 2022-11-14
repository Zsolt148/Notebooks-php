<?php
include("../resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 py-24 mx-auto max-w-7xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-8">Edit processor</h1>

		<?php include_once '../resources/views/shared/errors.php' ?>

        <form method="POST" action="<?php echo route($routes->get('processors.update'), $processor['id']); ?>" enctype=”multipart/form-data”>

			<?php include_once 'form.php' ?>

            <div class="flex justify-end mt-6">
                <div class="py-2 mr-5">
                    <a class="text-red-600 link" href="<?php echo route($routes->get('processors.delete'), $processor['id']); ?>">Delete</a>
                </div>
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