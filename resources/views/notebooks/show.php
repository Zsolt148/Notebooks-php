<?php
include("../resources/views/layouts/header.php");
?>
<section class="w-full px-6 pb-12 antialiased bg-white">
    <div class="px-10 py-24 mx-auto max-w-7xl">
        <h1>Show</h1>
        <p>
            <?php print_r($notebook) ?>
        </p>
    </div>
</section>

<?php
include("../resources/views/layouts/footer.php");
?>