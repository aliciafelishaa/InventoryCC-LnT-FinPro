<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chipi Chapa Inventory</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body >
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 1rem 2rem 1rem 2rem;">
        <div class="container-fluid">
          <h1 class="navbar-brand" href="#">PT Chipi Chapa</h1>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          {{-- <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Shopping Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Print Factur</a>
              </li>

            </ul>
          </div> --}}
        </div>
        <div class="d-flex gap-2 align-items-center">
            <form action="{{route('signin.page')}}" method="GET">
                @csrf
                <button type="submit" class="btn btn-success text-nowrap">Sign In</button>
            </form>
            <form action="{{route('signup.page')}}" method="GET">
                @csrf
                <button type="submit" class="btn btn-outline-success text-nowrap">Sign Up</button>
            </form>
        </div>
    </nav>

    <main>
        <section class="main-section">
            <h1 class="header">Welcome to PT Chipi Chapa Inventory</h1>
            <h2 class="header2">Get Started!</h2>
        </section>
    </main>

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
