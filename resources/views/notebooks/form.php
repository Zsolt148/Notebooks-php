<div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
	<div>
		<label class="text-gray-700" for="manufacturer">Manufacturer</label>
		<input id="manufacturer" name="manufacturer" type="text" value="<?php echo isset($notebook) ? $notebook['manufacturer'] : null ?>" required>
	</div>

	<div>
		<label class="text-gray-700" for="type">Type</label>
		<input id="type" name="type" type="text" value="<?php echo isset($notebook) ? $notebook['type'] : null ?>" required>
	</div>

	<div>
		<label class="text-gray-700" for="display">Display</label>
		<input id="display" name="display" type="text" value="<?php echo isset($notebook) ? $notebook['display'] : null ?>" required>
	</div>

	<div>
		<label class="text-gray-700" for="memory">Memory</label>
		<input id="memory" name="memory" type="number" value="<?php echo isset($notebook) ? $notebook['memory'] : null ?>" required>
	</div>
</div>
