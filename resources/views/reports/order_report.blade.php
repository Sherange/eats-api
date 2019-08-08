<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        />

        <title>Eats - Shops Report</title>
    </head>
    <body style="margin: 10px;" style="width:100%">
        <div class="container-fluid" style="border: 1px solid #000000">
            <div class="container" style="margin: 10px;">
                <h2>Food Court Management System</h2>
                <p>Order detail report</p>
            </div>

            <div style="margin:10px;">
                <div style="display: inline-block; width: 200px;">
                    <p>
                        <strong>Total Rev : {{ $balance }}</strong>
                    </p>
                </div>

                <div style="display: inline-block; width: 200px;">
                    <p>
                        <strong>Total Orders : {{ $length }}</strong>
                    </p>
                </div>
            </div>

            <table class="table" style="width:100%" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount (RS)</th>
                        <th scope="col">Table No</th>
                        <th scope="col">User</th>
                        <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)

                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <th>{{ $order->amount }}</th>
                        <th>{{ $order->table_id }}</th>
                        <th>{{ $order->name }}</th>
                        <th>{{ $order->created_at }}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
