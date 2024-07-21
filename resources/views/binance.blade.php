<!DOCTYPE html>
<html>
<head>
    <title>Binance Pay</title>
</head>
<body>
    <form action="/binance-pay/create-order" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount"><br><br>
        <label for="currency">Currency:</label>
        <input type="text" id="currency" name="currency" value="USDT"><br><br>
        <button type="submit">Pay with Binance Pay</button>
    </form>
</body>
</html>
