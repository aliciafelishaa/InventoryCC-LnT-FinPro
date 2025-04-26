<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 1rem 2rem 1rem 2rem;">
        <div class="container-fluid">
          <h1 class="navbar-brand" href="#">PT Chipi Chapa</h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('product.view.all.user')}}">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('cart.page')}}">Shopping Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Print Factur</a>
              </li>

            </ul>
          </div>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <form action="{{route('signout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger text-nowrap">Sign Out</button>
            </form>
        </div>
    </nav>
    <main>
        <div class="container">
            <h1>Generate Invoice</h1>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('invoice.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Shipping Address</label>
                    <textarea name="shipping_address" class="form-control" required minlength="10" maxlength="100"></textarea>
                </div>

                <div class="mb-3">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" class="form-control" required pattern="\d{5}">
                </div>

                <h2>Items</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php
                                $subtotal = $item->inventory->product_price * $item->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item->inventory->product_name }}</td>
                                <td>{{ $item->inventory->category->category_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Total: Rp{{ number_format($total, 0, ',', '.') }}</h3>

                <button class="btn btn-primary mt-3" type="submit">Generate Invoice</button>
            </form>
        </div>
    </main>

</body>
</html>
