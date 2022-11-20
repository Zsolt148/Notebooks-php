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
		<input id="display" name="display" type="number" step="0.1" value="<?php echo isset($notebook) ? $notebook['display'] : null ?>" required>
	</div>

	<div>
		<label class="text-gray-700" for="memory">Memory</label>
		<input id="memory" name="memory" type="number" value="<?php echo isset($notebook) ? $notebook['memory'] : null ?>" required>
	</div>

    <div>
        <label class="text-gray-700" for="harddisk">Harddisk</label>
        <input id="harddisk" name="harddisk" type="number" value="<?php echo isset($notebook) ? $notebook['harddisk'] : null ?>" required>
    </div>

    <div>
        <label class="text-gray-700" for="videocontroller">Videocontroller</label>
        <input id="videocontroller" name="videocontroller" type="text" value="<?php echo isset($notebook) ? $notebook['videocontroller'] : null ?>" required>
    </div>

    <div>
        <label class="text-gray-700" for="price">Price (ft)</label>
        <input id="price" name="price" type="number" value="<?php echo isset($notebook) ? $notebook['price'] : null ?>" required>
    </div>

    <div>
        <label class="text-gray-700" for="pieces">Pieces (db)</label>
        <input id="pieces" name="pieces" type="number" value="<?php echo isset($notebook) ? $notebook['pieces'] : null ?>" required>
    </div>

    <div>
        <label class="text-gray-700" for="opsystem_id">OP system</label>
        <select name="opsystem_id" id="opsystem_id">
            <?php foreach($opsystems as $op) { ?>
                <option value="<?php echo $op['id'] ?>" <?php if(isset($notebook) && $op['id'] == $notebook['opsystem_id']) echo 'selected' ?>><?php echo $op['os_name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div>
        <label class="text-gray-700" for="processor_id">Processor</label>
        <select name="processor_id" id="processor_id">
			<?php foreach($processors as $proc) { ?>
                <option value="<?php echo $proc['id'] ?>" <?php if(isset($notebook) && $proc['id'] == $notebook['processor_id']) echo 'selected' ?>><?php echo $proc['manufacturer'] . ' ' . $proc['type']; ?></option>
			<?php } ?>
        </select>
    </div>
</div>
