<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 1rem 2rem 1rem 2rem;">
        <div class="container-fluid">
          <h1 class="navbar-brand" href="#">Admin Panel</h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('product.view.all')}}">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('create.page')}}">Create Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('category.page')}}">Create Category</a>
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
        <h1 class="create-header">Update Product</h1>
        <section class="create-sec">
            <form action="{{route('update.product', $productUpdate->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- Product Name --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Product Name</b></label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Product ABC" name="product_name" value="{{$productUpdate->product_name}}">
                </div>
                @error('product_name')
                    <p class="alert alert-danger">{{$message}}</p>
                @enderror
                {{-- Product Price --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Product Price</b></label>
                    <div class="price-sec">
                        <p>Rp.</p>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="15000" name="product_price" value="{{$productUpdate->product_price}}">
                    </div>
                </div>
                @error('product_price')
                    <p class="alert alert-danger">{{$message}}</p>
                @enderror
                {{-- Product Quantity --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Product Quantity</b></label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="10" name="product_quantity" value="{{$productUpdate->product_quantity}}">
                </div>
                @error('product_quantity')
                    <p class="alert alert-danger">{{$message}}</p>
                @enderror
                {{-- Product Category --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Product Category</b></label>
                    <div class="dropdown">
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ $productUpdate->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                      </div>
                </div>
                @error('product_category')
                    <p class="alert alert-danger">{{$message}}</p>
                @enderror
                {{-- Product Photo --}}
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Product Photo</b></label>

                    {{-- Tampilkan foto lama --}}
                    @if($productUpdate->product_photo)
                        <p><b>Current Photo:</b></p>
                        <img src="{{ asset('storage/' . $productUpdate->product_photo) }}" alt="Current Product Photo" width="150" class="mb-2">
                    @endif

                    {{-- Input hidden untuk simpan path lama --}}
                    <input type="hidden" name="old_product_photo" value="{{ $productUpdate->product_photo }}">

                    {{-- Input file baru --}}
                    <input type="file" class="form-control" id="exampleFormControlInput1" name="product_photo">
                </div>
                @error('product_photo')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
