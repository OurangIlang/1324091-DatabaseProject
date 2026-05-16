<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE PRINT</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f1f1f1; }
        h1, h2 { text-align: center; }
        .transaction-details { margin-bottom: 20px; }
        .total-amount { text-align: right; margin-top: 20px; }
        p { margin: 0; }
        strong { font-weight: bold; }
        
        .medicine-list table { 
            width: 100%; 
            border-collapse: collapse; 
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        
        .medicine-list th, .medicine-list td { 
            padding: 4px; 
            text-align: center; 
            border: 1px solid #000;
        }
        
        .medicine-list th:first-child, 
        .medicine-list td:first-child {
            border-left: none;
        }
        
        .medicine-list th:last-child, 
        .medicine-list td:last-child {
            border-right: none;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f1f1f1;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <?php
        include '../koneksi.php';
        $invoice_id = $_GET['invoice_id'];
        
        $query_header = mysqli_query($conn, "SELECT i.*, c.* FROM invoice i JOIN customer c ON i.customer_id = c.customer_id WHERE i.invoice_id = '$invoice_id'");
        $header = mysqli_fetch_array($query_header);
        $invoice_date = date('d/m/Y', strtotime($header['invoice_date']));
        ?>
        
        <div style="text-align: left; margin-bottom: 20px">
            <p style="text-align: left; font-size: 0.67rem; width: 350px; margin: 0;">
                <img src="../images/kop.png" alt="" style="width: 350px; height: auto;"><br>
                <strong>JL. SIDOTOPO WETAN INDAH II/21 TELP(031) 3760550 SURABAYA</strong>
            </p>
        </div>

        <div style="display: flex; justify-content: space-between; font-family: sans-serif; font-size: small; font-weight: bold; margin-top: 20px;">
            <div style="width: 60%;">
                <div style="margin-bottom: 5px;">INVOICE TO: <?php echo $header['customer_id']; ?> <span style="margin-left: 60px;">/KH/_______</span></div>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 30%; border: 1px solid black; padding: 4px;">NAME</td>
                        <td style="border: 1px solid black; padding: 4px;">: <?php echo $header['customer_name']; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px;">ADDRESS</td>
                        <td style="border: 1px solid black; padding: 4px;">: <?php echo $header['address']; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px;">CITY</td>
                        <td style="border: 1px solid black; padding: 4px;">: <?php echo $header['city']; ?></td>
                    </tr>
                </table>
            </div>

            <div style="width: 35%;">
                <div style="margin-bottom: 5px;">DATE : <?php echo $invoice_date; ?></div>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid black; padding: 4px;">NO. PO</td>
                        <td style="border: 1px solid black; padding: 4px;">: <?php echo $header['no_po']; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px;">NO. PR</td>
                        <td style="border: 1px solid black; padding: 4px;">: <?php echo $header['no_pr']; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 4px;">PAYMENT</td>
                        <td style="border: 1px solid black; padding: 4px;">: <?php echo number_format($header['payment'], 0, ',', '.'); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="medicine-list" style="margin-top: 10px; font-size: 0.9rem">
            <table>
                <thead>
                    <tr>
                        <th style="width: 15%;">ORDER</th>
                        <th style="width: 35%;">DESCRIPTION</th>
                        <th style="width: 20%;">PRICE</th>
                        <th style="width: 10%;">PER</th>
                        <th style="width: 20%;">EXTENSION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_final = 0;
                    $rowCount = 0;
                    $query_detail = mysqli_query($conn, "SELECT id.*, p.description, p.price, p.unit 
                        FROM invoice_detail id 
                        JOIN product p ON id.product_id = p.product_id 
                        WHERE id.invoice_id = '$invoice_id'");

                    while ($row = mysqli_fetch_array($query_detail)) {
                        $total_final += $row['extension'];
                        $rowCount++;
                    ?>
                        <tr>
                            <td><?php echo $row['quantity'] . " " . strtoupper($row['unit']); ?></td>
                            <td style="text-align: left;"><?php echo strtoupper($row['description']); ?></td>
                            <td style="text-align: center;">Rp. <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                            <td><?php echo strtolower($row['unit']); ?></td>
                            <td style="text-align: left;">Rp. <?php echo number_format($row['extension'], 0, ',', '.'); ?>,-</td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="1" style="text-align: right; padding: 4px; border-bottom: none;"></td>
                        <td colspan="1" style="text-align: right; padding: 4px; border-bottom: none;"></td>
                        <td colspan="1" style="text-align: right; padding: 4px; border-bottom: none;"></td>
                        <td colspan="1" style="text-align: right; padding: 4px; border-bottom: none;"></td>
                        <td colspan="4"style="text-align: left; padding: 4px;"><strong>Rp. <?php echo number_format($total_final, 0, ',', '.'); ?>,-</strong></td>
                    </tr>

                    <?php
                    // Baris Kosong sisa untuk estetika
                    for ($i = $rowCount + 1; $i < 10; $i++) {
                        echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div style="display: flex; justify-content: flex-start; margin-top: 30px;">
            <div style="text-align: left; position: relative;">
                <div style="margin: 10px 0;">
                    <img src="../images/ttds.png" alt="" style="width: 160px; height: auto; position: relative; z-index: 1; bottom: 16px; left: 80px;">
                    <img src="../images/stempel.png" alt="" style="width: 280px; height: auto; position: absolute; bottom: 1px; left: 0px; opacity: 0.5;">
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
            <div style="text-align: center; position: relative; bottom : 151px; right: 60px; font-size: 16px; ">
                <p><strong>Tanda Terima</strong></p>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>