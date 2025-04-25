<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
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
    @if(session('success'))
    <p>{{ session('success') }}</p>
    @endif

    <main>
        <div>
            <h1>Shopping Cart</h1>
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>

        <div>
            @if ($cartItems->count() >0)
            <table class="table
            ">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>Rp{{ number_format($item->product->product_price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>Rp{{ number_format($item->product->product_price * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
                <h4>Total: Rp{{ number_format($total, 0, ',', '.') }}</h4>
                <a href="{{ route('cart.clear') }}" class="btn btn-warning">Kosongkan Keranjang</a>
                <a href="{{ route('checkout') }}" class="btn btn-success">Lanjut Checkout</a>
            @else
            <p  class="alert alert-danger">Your Shopping Cart is Empty</p>
            @endif
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
