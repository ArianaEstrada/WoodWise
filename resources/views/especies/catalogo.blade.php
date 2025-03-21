@extends('dashboard')

@section('template_title', 'Catálogo de Especies')

@section('crud_content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">
        <i class="fas fa-seedling"></i> Catálogo de Especies
    </h2>

    <div id="carouselEspecies" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($especies->chunk(3) as $index => $chunk)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="row justify-content-center">
                        @foreach($chunk as $especie)
                            <div class="col-md-4">
                                <div class="card shadow-sm mb-4">
                                <img src="{{ asset('storage/' . $especie->imagen) }}" class="card-img-top" alt="{{ $especie->nom_comun }}">
                                <div class="card-body text-center">
                                        <h5 class="card-title">{{ $especie->nom_comun }}</h5>
                                        <p class="card-text text-muted"><em>{{ $especie->nom_cientifico }}</em></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselEspecies" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselEspecies" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!-- Agregar estilos personalizados -->
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card img {
        height: 250px;
        object-fit: cover;
    }
</style>

@endsection
