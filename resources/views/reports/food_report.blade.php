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

        <title>Eats - Food Item Report</title>
    </head>
    <body style="margin: 10px;">
        <div class="container" style="border: 1px solid #000000">
            <div class="container" style="margin: 10px;">
                <h2>Food Court Management System</h2>
                <p>Foods detail report</p>
            </div>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Food Name</th>
                        <th scope="col">Cuisines available</th>
                        <th scope="col">Opening hours</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($foods as $food)
                    <tr>
                        <th scope="row">{{ $food->id }}</th>
                        <td>{{ $food->name}}</td>
                        <td>{{ $food->category }}</td>
                        <td>{{ $food->price }}</td>
                        <td>{{ $food->shop->name }}</td>
                        <td>{{ $food->created_at }}</td>
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
