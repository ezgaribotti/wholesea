<html>
    <p>Order paid!</p>
    <p>We’ve successfully received payment for your order ({{ $order_id }}).<br>If you’d like to check the status of your shipment, you can do so using your tracking code. Alternatively, feel free to contact our support team and provide the tracking code for assistance.</p>

    <ul>
        <li>Tracking code: {{ $tracking_code }}</li>
        <li>Total paid: ${{ $total_paid }} ({{ $currency }})</li>
        <li>Date: {{ $date }}</li>
    </ul>

    @if($shipping_paid)
        <strong>Shipping charges have also been paid. Your order will be shipped without any additional fees.</strong>
    @endif

    <p>We are now processing your order and will notify you once it has been shipped. If you have any questions or need assistance, feel free to contact our support team.</p>
    <p>Thank you for your purchase!</p>
</html>
