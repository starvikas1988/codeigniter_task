<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Order List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order->id; ?></td>
                        <td><?php echo $order->category; ?></td>
                        <td><?php echo $order->product; ?></td>
                        <td><?php echo $order->order_date; ?></td>
                        <td><?php echo $order->delivery_date; ?></td>
                        <td><?php echo $order->unit_price; ?></td>
                        <td><?php echo $order->quantity; ?></td>
                        <td><?php echo $order->subtotal; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <?php 
                $total = 0;
                foreach($orders as $order){
                    $total += $order->subtotal;
                }
            ?>
            <h2><?php echo "Total : ".$total; ?></h2>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
