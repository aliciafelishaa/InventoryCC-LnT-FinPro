<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Chipi Chapa Inventory</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 1rem 2rem;">
        <div class="container-fluid">
            <h1 class="navbar-brand">PT Chipi Chapa</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('product.view.all.user') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('cart.page') }}">Shopping Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Print Factur</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <form action="{{ route('signout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        <h1 class="create-header text-center my-4">Shopping Cart</h1>
        <section class="h-100 h-custom">
            <div class="container h-100 py-5">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col">
                        @if(count($cartItems) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="h5">Shopping Bag</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $id => $item)
                                    <tr>
                                        {{-- Name & photo --}}
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $item->inventory->product_photo) }}" class="img-fluid rounded-3" style="width: 120px;" alt="Product Image">
                                                <div class="flex-column ms-4">
                                                    <p class="mb-2">{{ $item->inventory->product_name }}</p>
                                                </div>
                                            </div>
                                        </th>
                                        {{-- Category --}}
                                        <td class="align-middle">
                                            <p class="mb-0" style="font-weight: 500;">{{ $item->inventory->category->category_name ?? '-' }}</p>
                                        </td>
                                        {{-- Quantity --}}
                                        <td class="align-middle">
                                            <form action="{{ route('cart.update', $item->inventory_id) }}" method="POST" class="d-flex flex-row">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-link px-2" type="submit" name="action" value="decrease">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 50px;" readonly />
                                                <button class="btn btn-link px-2" type="submit" name="action" value="increase">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </td>
                                        {{-- Price --}}
                                        <td class="align-middle">
                                            Rp{{ number_format($item->inventory->product_price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Total --}}
                        @php
                            $total = 0;
                            foreach($cartItems as $item) {
                                $total += $item->inventory->product_price * $item->quantity;
                            }
                        @endphp

                        <div class="d-flex justify-content-between" style="font-weight: 500;">
                            <p class="mb-2">Subtotal</p>
                            <p class="mb-2">Rp{{ number_format($total, 0, ',', '.') }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                            <p class="mb-2">Total (tax included)</p>
                            <p class="mb-2">Rp{{ number_format($total, 0, ',', '.') }}</p>
                        </div>

                        {{-- Generate Faktur --}}
                        <form action="{{route('invoice.form')}}" method="GET">
                            @csrf
                            <button class="btn btn-primary" type="submit">Generate Factur</button>
                        </form>
                        @else
                        <div class="alert alert-danger text-center" role="alert">
                            Your cart is empty. Go shopping now!
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
