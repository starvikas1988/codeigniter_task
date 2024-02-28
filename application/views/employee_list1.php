<!-- application/views/items/index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h1>Items</h1>
    
    <!-- Form for adding new item -->
    <form id="addItemForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <button type="submit">Add Item</button>
    </form>

    <!-- List of items -->
    <h2>Item List</h2>
    <ul id="itemList">
        <?php foreach ($items as $item): ?>
            <li><?php echo $item->name; ?> - <?php echo $item->description; ?></li>
        <?php endforeach; ?>
    </ul>

    <script>
        $(document).ready(function(){
            $('#addItemForm').submit(function(e){
                e.preventDefault(); // Prevent the form from submitting normally
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('employee_controller/add'); ?>',
                    data: formData,
                    success: function(response){
                        $('#itemList').append(response); // Append the new item to the list
                        $('#addItemForm')[0].reset(); // Reset the form
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        // $(document).ready(function(){
        //     $('#addFormData').submit(function (e) {
        //         e.preventDefault();
        //         var formData = $(this).serialize();
        //         $.ajax({
        //             type:'POST',
        //             url:'<?php //echo base_url('controller/method');?>',
        //             data:formData,
        //             success: function(response){
        //                 $('#className').append(response);
        //                 $('#formClass')[0].reset();
        //             }
        //         });
        //     });  
        // });
    </script>
</body>
</html>
