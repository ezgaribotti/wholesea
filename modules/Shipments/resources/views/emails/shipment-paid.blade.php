<html>
    <p>Shipment paid!</p>
    <p>We’ve successfully received payment for your shipment ({{ $shipment_id }}).<br>If you’d like to check the status of your shipment, you can do so using your tracking code.</p>

    <ul>
        <li>Tracking code: {{ $tracking_code }}</li>
        <li>Cost: ${{ $cost }} ({{ $currency }})</li>
        <li>Date: {{ $date }}</li>
    </ul>

    <p>You will be notified at this same email about the shipping status and its corresponding stage.</p>
    <p>Thank you!</p>
</html>
