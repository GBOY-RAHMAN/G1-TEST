<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../signup_system/dbh.inc.php';

$sql = "SELECT trade_id, coinname, percentage, amount, trade_date, country FROM trades";
$result = $conn->query($sql);

if (!$result) {
    echo "Query failed: " . $conn->error;
}
?>
<!doctype html>
<html>
<head>
  <!-- Include jQuery and jQuery Modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex bg-black">

<nav class="">
    <section class="h-[100vh] fixed">
        <?php include_once 'sidebar.php'; ?>
    </section>
</nav>

<main class="ml-[60px] h-[100vh] bg-[#18181b] my-2 text-white w-full shadow-2xl rounded-l-2xl">
    <div class="p-10">
        <div class="mb-4">
            <p class="text-sm font-medium">OVERVIEW</p>
        </div>
        <section class="flex space-x-12">
            <!-- Add your overview content here -->
        </section>
    </div>

    <div>
        <?php
        if (isset($_GET['success'])) {
            echo "<p style='color: green;'>Trade successfully added!</p>";
        } elseif (isset($_GET['error'])) {
            echo "<p style='color: red;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>
        <section>
            <h1 class="text-2xl font-bold mb-4">Trading Dashboard</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-center">Trade ID</th>
                            <th class="py-3 px-6 text-center">COIN~Name</th>
                            <th class="py-3 px-6 text-center">Trading Percentage</th>
                            <th class="py-3 px-6 text-center">Trading Amount</th>
                            <th class="py-3 px-6 text-center">Entry Date</th>
                            <th class="py-3 px-6 text-center">Country</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
                                        <td class='py-3 px-6 text-center'>" . htmlspecialchars($row['trade_id']) . "</td>
                                        <td class='py-3 px-6 text-center'>" . htmlspecialchars($row['coinname']) . "</td>
                                        <td class='py-3 px-6 text-center'>" . htmlspecialchars($row['percentage']) . "</td>
                                        <td class='py-3 px-6 text-center text-green-500'>" . htmlspecialchars($row['amount']) . "</td>
                                        <td class='py-3 px-6 text-center'>" . htmlspecialchars($row['trade_date']) . "</td>
                                        <td class='py-3 px-6 text-center'>
                                            <span class='bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs'>" . htmlspecialchars($row['country']) . "</span>
                                        </td>
                                        <td class='py-3 px-6 text-center'>
                                            <form method='post' action='../tradingfile/processtrade.php' style='display:inline-block;'>
                                                <input type='hidden' name='action' value='delete'>
                                                <input type='hidden' name='trade_id' value='" . htmlspecialchars($row['trade_id']) . "'>
                                                <button type='submit' class='bg-amber-900 text-white px-3 py-1 rounded'>Withdraw</button>
                                            </form>
                                            <button type='button' class='bg-blue-500 text-white px-3 py-1 rounded update-btn' data-id='" . htmlspecialchars($row['trade_id']) . "' data-coinname='" . htmlspecialchars($row['coinname']) . "' data-percentage='" . htmlspecialchars($row['percentage']) . "' data-amount='" . htmlspecialchars($row['amount']) . "' data-date='" . htmlspecialchars($row['trade_date']) . "' data-country='" . htmlspecialchars($row['country']) . "'>Update</button>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='py-3 px-6 text-center'>No trades found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<!-- Modal HTML embedded directly into document -->
<div id="update-modal" class="modal">
    <h2 class="text-xl font-bold mb-4">Update Trade</h2>
    <form id="update-form" action="../tradingfile/processtrade.php" method="post">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="trade_id" id="update-trade-id">

        <label for="update-coinname" class="block mb-2 text-sm font-medium text-gray-900">Coinname</label>
        <input type="text" name="coinname" id="update-coinname" class="w-full p-2 mb-4 border rounded-md" required>

        <label for="update-percentage" class="block mb-2 text-sm font-medium text-gray-900">Trading Percentage</label>
        <input type="text" name="percentage" id="update-percentage" class="w-full p-2 mb-4 border rounded-md" required>

        <label for="update-amount" class="block mb-2 text-sm font-medium text-gray-900">Trading Amount</label>
        <input type="number" name="amount" id="update-amount" class="w-full p-2 mb-4 border rounded-md" required>

        <label for="update-date" class="block mb-2 text-sm font-medium text-gray-900">Entry Date</label>
        <input type="date" name="date" id="update-date" class="w-full p-2 mb-4 border rounded-md" required>

        <label for="update-country" class="block mb-2 text-sm font-medium text-gray-900">Country</label>
        <select name="country" id="update-country" class="w-full p-2 mb-4 border rounded-md">
            <option value="Nigeria">Nigeria</option>
            <option value="Canada">Canada</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Update Trade</button>
    </form>
</div>

<script src="../javascript/script.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/891c2fc307.js" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $('.update-btn').click(function() {
        const tradeId = $(this).data('id');
        const coinname = $(this).data('coinname');
        const percentage = $(this).data('percentage');
        const amount = $(this).data('amount');
        const date = $(this).data('date');
        const country = $(this).data('country');

        $('#update-trade-id').val(tradeId);
        $('#update-coinname').val(coinname);
        $('#update-percentage').val(percentage);
        $('#update-amount').val(amount);
        $('#update-date').val(date);
        $('#update-country').val(country);

        $('#update-modal').modal('show');
    });
});
</script>

</body>
</html>
