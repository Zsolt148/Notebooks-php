<?php
include("../resources/views/layouts/header.php");
?>
    <section class="w-full px-6 pb-12 antialiased bg-white">
        <div class="px-10 py-24 mx-auto max-w-7xl">
            <h1 class="text-2xl font-semibold text-gray-700 mb-8">Show</h1>

            <a class="mt-5" href="<?php echo route($routes->get('notebooks.edit'), $notebook['id']); ?>">
                Edit
            </a>
        </div>
    </section>
<?php
include("../resources/views/layouts/footer.php");
?>