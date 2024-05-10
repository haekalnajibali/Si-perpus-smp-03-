<style>
    .navbar {
        background-image: linear-gradient(to right, rgba(255, 0, 0, 0), #54B435);
    }
</style>

<nav class="navbar fixed-top navbar-dark navbar-expand-lg" style="background-color: #54B435;">
    <div class="container-fluid px-4">
        <a class="navbar-brand mb-0 h1" href="/dashboard">SI Perpus | Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
        </div>
        <h5 class="justify-content-center mx-3 text-white mt-2">Hai, {{ auth()->user()->nama }}</h5>
        <p class="text-white mx-3 mb-1">{{ auth()->user()->jabatan }}</p>
        <div class="d-flex justify-content-center mx-2">
            <form class="d-flex" action="/logout" method="post">
                @csrf
                <button class="btn btn-danger" type="submit">Keluar</button>
            </form>

        </div>
    </div>
</nav>