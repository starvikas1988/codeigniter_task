<!DOCTYPE html>
<html>
<head>
    <title>CRUD with CodeIgniter</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<h2>Items</h2>

<form id="itemForm">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="description" placeholder="Description">
    <input type="number" name="phone" placeholder="">
    <button type="submit">Add Item</button>
</form>

<ul id="itemList">
</ul>

<div id="editFormContainer" style="display: none;">
    <h3>Edit Item</h3>
    <form id="editForm">
        <input type="hidden" name="edit_id" id="edit_id">
        <input type="text" name="edit_name" id="edit_name" placeholder="Name">
        <input type="text" name="edit_description" id="edit_description" placeholder="Description">
        <input type="text" name="edit_phone" id="edit_phone" placeholder="">
        <button type="submit">Update Item</button>
        <button type="button" onclick="cancelEdit()">Cancel</button>
    </form>
</div>

<script>
    $(document).ready(function(){
        // Load items on page load
        loadItems();

        // Handle form submission
        $('#itemForm').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '<?php echo base_url("items/add_item"); ?>',
                type: 'POST',
                data: formData,
                success: function(response){
                    var data = JSON.parse(response);
                    if(data.item_id) {
                        alert('Item added successfully!');
                        loadItems();
                        $('#itemForm')[0].reset(); // Clear form fields
                    }
                }
            });
        });

        // Function to load items via AJAX
        function loadItems() {
            $.ajax({
                url: '<?php echo base_url("items/get_items"); ?>',
                type: 'GET',
                success: function(response){
                    var data = JSON.parse(response);
                    $('#itemList').empty();
                    $.each(data, function(index, item){
                        var listItem = $('<li>' + item.name + ' - ' + item.description + ' - '+ item.phone + '</li>');
                        var editButton = $('<button onclick="editItem(' + item.id + ', \'' + item.name + '\', \'' + item.description + '\',\'' + item.phone + '\')">Edit</button>');
                        var deleteButton = $('<button onclick="deleteItem(' + item.id + ')">Delete</button>');
                        listItem.append(editButton).append(deleteButton);
                        $('#itemList').append(listItem);
                    });
                }
            });
        }

        // Function to show edit form
        window.editItem = function(id, name, description,phone) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_description').val(description);
            $('#edit_phone').val(phone);
            $('#editFormContainer').show();
        }

        // Function to cancel edit
        window.cancelEdit = function() {
            $('#editFormContainer').hide();
        }

        // Handle edit form submission
        $('#editForm').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: '<?php echo base_url("items/update_item"); ?>',
                type: 'POST',
                data: formData,
                success: function(response){
                    var data = JSON.parse(response);
                    console.log(data);
                    if(data.success) {
                        alert('Item updated successfully!');
                        loadItems();
                        cancelEdit();
                    }
                }
            });
        });

        // Function to delete item
        window.deleteItem = function(id) {
            if(confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: '<?php echo base_url("items/delete_item"); ?>',
                    type: 'POST',
                    data: {id: id},
                    success: function(response){
                        var data = JSON.parse(response);
                        if(data.success) {
                            alert('Item deleted successfully!');
                            loadItems();
                        }
                    }
                });
            }
        }
    });
</script>

</body>
</html>
