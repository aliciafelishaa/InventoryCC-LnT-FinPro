<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
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
        <h1 class="create-header">Product List</h1>
        <section class="create-sec">
            <div class="filter-prod-header">
                <h2>Filter Produk</h2>
                    <a href="{{route('product.view.all.user')}}"><button class="btn btn-success">Semua</button></a>
                    @foreach ($category as $cat)
                        <a href="{{route('product.view.filter.user', ['id' => $cat->id])}}">
                            <button class="btn btn-primary">{{$cat->category_name}}</button>
                        </a>
                    @endforeach
            </div>

            <div>
                <h2>Daftar Produk</h2>
                <div class="product-card-lay">
                    @forelse ($product as $prod)
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('storage/' . $prod->product_photo)}}" class="card-img-top" alt="{{$prod->product_name}}">
                            <div class="card-body">
                            <h5 class="card-title">{{$prod->product_name}}</h5>
                            <p class="card-text">Harga: Rp{{$prod->product_price}}</p>
                            <p class="card-text">Stok: {{$prod->product_quantity}}</p>
                            <p class="card-text">Kategori: {{$prod->category->category_name}}</p>
                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                        </div>
                    @empty
                    <p class="alert alert-danger">Product is Empty</p>

                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
