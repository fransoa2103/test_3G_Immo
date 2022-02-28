@extends('layouts.main')
@section('content')

    <div class="row">

        <!-- views/includes/sidebar.blade.php -->
        <div class="col-lg-3">
            @include('includes.sidebar')
        </div>

        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
            
            <!-- affiche un message de success lorsqu'un nouvel utilisateur s'inscrit ou se  connecte -->
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            {{-- début du post --}}
            @foreach($Annonces as $annonce)
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('annonces.show', ['annonce'=>$annonce->reference_annonce]) }}">Annonce # {{ $annonce->reference_annonce }}</a></h5>
                        <p class="card-text">description : {{ $annonce->description_annonce }}</p>
                        <p class="card-text">nb pièce(s) : {{ $annonce->nombre_de_piece }}</p>
                        <p class="card-text">Surface habitable : {{ $annonce->surface_habitable }} m²</p>
                        <p class="card-text bold">Prix : <?= number_format($annonce->prix_annonce, 2, ',', ' ') ?>€</p>
                        
                        <span class="time">Posté 
                            {{ $annonce->created_at->diffForHumans()}} le 
                            {{ $annonce->created_at->isoFormat('LL')}}
                        </span>
                        </br>
                        <span class="author">par 
                        <a href="{{ route('user.profile', ['user'=>$annonce->user->id]) }}">{{ $annonce->user->first_name }} {{ $annonce->user->last_name }}</a></span> <br>


                        {{-- @if(Auth::check() && Auth::user()->id == $annonce->user_id)
                            <div class="author mt-3">
                                <a href="{{ route('Annonces.edit', ['annonce'=>$annonce->ref_annonce]) }}" class="btn btn-secondary">Modifier</a>
                                <form style="display: inline;" action="{{ route('Annonces.destroy', ['annonce'=>$annonce->ref_annonce]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">X</button>
                                </form>
                            </div>
                        @endif --}}

                    </div>
                </div>
            @endforeach
            {{-- fin du post --}}

            {{-- début de pagination --}}
            <div class="pagination mt-5">
                {{ $Annonces->links()}}
            </div>
            {{-- fin de pagination --}}

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

@stop