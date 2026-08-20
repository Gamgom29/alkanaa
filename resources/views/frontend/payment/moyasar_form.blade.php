<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pay with Moyasar</title>

  <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css">
  <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>
</head>
<body>

  <div class="mysr-form"></div>

  <script>
    Moyasar.init({
      element: '.mysr-form',
      amount: {{ $amountHalalah }},
      currency: 'SAR',
      description: @json($description),
      publishable_api_key: @json($publishableKey),
      callback_url: @json($callbackUrl),
      methods: ['creditcard'], // ممكن تضيف stcpay لو مفعّل عندك
      supported_networks: ['mada', 'visa', 'mastercard', 'amex']
    });
  </script>

</body>
</html>
