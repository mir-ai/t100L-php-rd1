<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Install Bootstrap 5 in Laravel 12 with Vite - ItStuffSolutiotions</title>
 
    {{-- Vite Assets --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
 
<body>
 
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ItStuffSolutiotions</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
 
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
 
    {{-- Main Section --}}
    <div class="container my-5">
 
        {{-- Alerts --}}
        <div class="alert alert-success">Bootstrap 5.3.8 Loaded Successfully!</div>
        <div class="alert alert-primary">This is a primary alert.</div>
 
        {{-- Buttons --}}
        <div class="mb-4">
            <button class="btn btn-primary">Primary</button>
            <button class="btn btn-success">Success</button>
            <button class="btn btn-danger">Danger</button>
            <button class="btn btn-outline-dark">Outline</button>
        </div>
 
        {{-- Cards --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Card Title One</h5>
                        <p class="card-text">This is a short description inside the card.</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
 
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Card Title Two</h5>
                        <p class="card-text">This card includes a button and sample text.</p>
                        <button class="btn btn-success btn-sm">Explore</button>
                    </div>
                </div>
            </div>
 
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Card Title Three</h5>
                        <p class="card-text">Another clean Bootstrap card layout.</p>
                        <button class="btn btn-outline-primary btn-sm">Details</button>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
 
    {{-- Footer --}}
    <footer class="bg-light py-3 border-top mt-5">
        <div class="container text-center">
            <small>© {{ date('Y') }} ItStuffSolutiotions.io. All rights reserved.</small>
        </div>
    </footer>
 
</body>
</html>