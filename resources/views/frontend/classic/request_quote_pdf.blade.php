<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        @font-face {
            font-family: 'Cairo';
        }

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>{{ translate('get_a_quote') }}</h1>

    <table>
        <thead>
            <tr>
                <th>{{ translate('product') }}</th>
                <th>{{ translate('quantity') }}</th>
                <th>{{ translate('price') }}</th>
                <th>{{ translate('total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>{{ translate('total') }}</td>
                <td colspan="3">{{ $total }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
