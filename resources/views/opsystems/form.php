<div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
	<div>
		<label class="text-gray-700" for="os_name">Opsystem name</label>
		<input id="os_name" name="os_name" type="text" required value="<?php echo isset($opsystem) ? $opsystem['os_name'] : null ?>" <?php echo isset($disabled) ? 'disabled' : '' ?>>
	</div>
</div>
