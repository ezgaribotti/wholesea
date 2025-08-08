<html>
    <p>News of your shipment!</p>
    <p>We’re reaching out to let you know that the tracking status of your shipment ({{ $shipment_id }}) has been updated.</p>

    <ul>
        <li>Tracking code: {{ $tracking_code }}</li>
        <li>Status: <strong>{{ $status }}</strong></li>
        <li>Date: {{ $date }}</li>
    </ul>

    <p>If you have any questions or need help, feel free to contact our support team.</p>
    <p>Thank you!</p>
</html>
