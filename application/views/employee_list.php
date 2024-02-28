<?php 
defined('BASEPATH') or exit('No direct script access allowed');
// echo"<pre>";
// print_r($employee_list_data);
// echo"</pre>";

?>

<!-- application/views/items/index.php -->

<h2>Items</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($employee_list_data as $item): ?>
    <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->description; ?></td>
        <td>
            <a href="<?php echo base_url('employee_controller/edit/'.$item->id); ?>">Edit</a>
            <a href="<?php echo base_url('employee_controller/delete/'.$item->id); ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div>
	<a href="<?php echo base_url('employee_controller/add_form'); ?>">Add Employee</a>
</div>


