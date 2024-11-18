<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .break {
            page-break-before: always;
        }

        .container {

            max-width: 1200px;
            /* Adjust as needed */
            margin: 0 auto;

        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .border {
            border: 1px solid black;
            /* Default border color */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            /* Combine table borders */
        }

        .table td {
            padding: 10px;
            /* Add padding */
            border: 1px solid #ddd;
            /* Table cell border color */
        }

        h4 {
            margin-top: 20px;
            /* Spacing for header */
        }

        hr {
            border: 0;
            height: 6px;
            background-color: black;
            /* Set the color of the horizontal line */
        }

        /* Additional Styles */
        img {
            height: 70px;
            width: 70px;
        }

        strong {
            font-weight: bold;
        }

        .col {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .col-md-2 {
            flex: 0 0 16.67%;
            /* Approximation of Bootstrap's 2/12 */
            max-width: 16.67%;
        }

        .col-md-2.text-end {
            float: right;
            /* Maintain the float for this element */
        }

        /* Miscellaneous */
        .table tr {
            height: 40px;
            /* Adjust row height as needed */
        }
    </style>

</head>

<body>
    @foreach ($jobs as $job)
        <div class="break">
            <div class="container" style="height: 80px;">
                <div class="col-md-2 text-end">

                    <img src="data:image/png;base64,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"
                        alt="">
                </div>
            </div>
            <div class="container text-center">
                <h4>Invoice</h4>
                <hr>
            </div>
            <div class="container">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 70%;"><strong>Invoice to:</strong> {{ $job['invoice_to'] }}</td>
                        <td><strong>Invoice No:</strong> {{ $job['id'] }} </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><strong>Date:</strong> {{ Carbon\Carbon::now()->format('Y-m-d') }}</td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td><strong>Quantity</strong> </td>
                        <td style="width: 60%;"><strong>Description</strong> </td>
                        <td><strong>VAT</strong> </td>
                        <td><strong>Goods</strong> </td>
                    </tr>
                    <tr style="min-height: 280px;">
                        <td style="min-height: 280px;">{{ $job['quantity'] }}</td>
                        <td style="width: 60%; min-height: 280px;">{{ $job['description'] }}</td>
                        <td style="min-height: 280px;"></td>
                        <td style="min-height: 280px;">{{ $job['item'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Sub Total</strong> </td>
                        <td style="width: 60%;"></td>
                        <td style="background: rgba(128, 128, 128, 0.808)"></td>
                        <td>{{ $job['price'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Vat Total</strong> </td>
                        <td style="width: 60%;"></td>
                        <td style="background: rgba(128, 128, 128, 0.808)"></td>
                        <td>{{ $job['price'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong> </td>
                        <td style="width: 60%;"></td>
                        <td style="background: rgba(128, 128, 128, 0.808)"></td>
                        <td>{{ $job['price'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="container" style="margin-top: 20px;">
                <div class="col text-center">
                    <strong>
                        Payment is due upon receipt of invoice. <br>
                        All goods remain the property of Liquid Print until fully paid for. <br>
                        The management reserves the right to withhold goods until all funds have cleared. <br>
                        Bank details: <span style="color: red;">Account Name: Liquid Print, Sort Code: 09-02-22, Account
                            No.:
                            10696839</span><br>
                        Touchwood Media Services Limited trading as Liquid Print <br>
                        43 Great Lister Street, Nechells, Birmingham. B7 4LW. <br>
                        Tel/Fax: 0121 359 8807 E-mail: enquires@liquidprint.co.uk <br>
                        Web: http://www.liquidprint.co.uk <br>
                        Company Registered in England. Registration No. 04451068. V.A.T No. 812 3924 46
                    </strong>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
