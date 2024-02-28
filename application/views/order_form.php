<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dynamic Form</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Additional Custom Styles */
    .orderRow {
        margin-bottom: 20px;
    }
</style>
</head>
<body>
<div class="container">
    <form id="orderForm" action="<?php echo base_url('orders/add_order'); ?>" method="post">
        <div id="orderRows">
            <div class="orderRow row">
                <div class="col-md-2">
                    <label for="category" class="form-label">Category:</label>
                    <input type="text" name="category[]" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="product" class="form-label">Product:</label>
                    <input type="text" name="product[]" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="orderDate" class="form-label">Order Date:</label>
                    <input type="date" name="orderDate[]" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="deliveryDate" class="form-label">Delivery Date:</label>
                    <input type="date" name="deliveryDate[]" class="form-control" required>
                </div>
                <div class="col-md-1">
                    <label for="unitPrice" class="form-label">Unit Price:</label>
                    <input type="number" name="unitPrice[]" class="form-control" required>
                </div>
                <div class="col-md-1">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" name="quantity[]" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="subtotal" class="form-label">Subtotal:</label>
                    <input type="text" name="subtotal[]" class="form-control subtotal" readonly>
                </div>
            </div>
        </div>
        <button type="button" id="addRowButton" class="btn btn-primary">Add Row</button>
        <div class="mt-3">
            <label for="total" class="form-label">Overall Total:</label>
            <input type="text" id="total" class="form-control" readonly>
        </div>
        <div class="mt-3">
        	<button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<div class="mt-3">
        <a href="<?php echo base_url('orders/order_list');?>" target="_blank">View Products </a>
</div>


<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("addRowButton").addEventListener("click", function() {
        var orderRows = document.getElementById("orderRows");
        var newOrderRow = document.createElement("div");
        newOrderRow.classList.add("orderRow", "row");
        newOrderRow.innerHTML = `
            <div class="col-md-2">
                <label for="category" class="form-label">Category:</label>
                <input type="text" name="category[]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="product" class="form-label">Product:</label>
                <input type="text" name="product[]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="orderDate" class="form-label">Order Date:</label>
                <input type="date" name="orderDate[]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="deliveryDate" class="form-label">Delivery Date:</label>
                <input type="date" name="deliveryDate[]" class="form-control" required>
            </div>
            <div class="col-md-1">
                <label for="unitPrice" class="form-label">Unit Price:</label>
                <input type="number" name="unitPrice[]" class="form-control" required>
            </div>
            <div class="col-md-1">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="quantity[]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="subtotal" class="form-label">Subtotal:</label>
                <input type="text" name="subtotal[]" class="form-control subtotal" readonly>
            </div>
        `;
        orderRows.appendChild(newOrderRow);
    });

    // Calculate subtotal for each row and overall total
    document.getElementById("orderRows").addEventListener("input", function() {
        var subtotals = document.querySelectorAll(".subtotal");
        var total = 0;
        subtotals.forEach(function(subtotalInput) {
            var unitPrice = parseFloat(subtotalInput.parentNode.parentNode.querySelector("[name='unitPrice[]']").value) || 0;
            var quantity = parseFloat(subtotalInput.parentNode.parentNode.querySelector("[name='quantity[]']").value) || 0;
            var subtotal = unitPrice * quantity;
            subtotalInput.value = subtotal.toFixed(2);
            total += subtotal;
        });
        document.getElementById("total").value = total.toFixed(2);
    });
</script>
</body>
</html>
