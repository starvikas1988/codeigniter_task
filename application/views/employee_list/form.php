<!-- application/views/items/form.php -->

<h2><?php echo isset($item) ? 'Edit Item' : 'Add Item'; ?></h2>

<form method="post" action="<?php echo isset($item) ? base_url('employee_controller/edit/'.$item->id) : base_url('employee_controller/add'); ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo isset($item) ? $item->name : ''; ?>" required>
    <br>
    <label for="description">Description:</label>
    <textarea name="description"><?php echo isset($item) ? $item->description : ''; ?></textarea>
    <br>
    <input type="submit" value="Submit">
</form>
