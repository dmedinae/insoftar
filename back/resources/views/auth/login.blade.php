@extends('layouts.app') 

@section('content')
    <form method="post" action="{{ url('login')}}">
        {!! csrf_field() !!}
        <div class="container-fluid">
            @if ( count( $errors ) > 0 )
                @foreach ($errors->all() as $error)
                    {{ $error }}        
                @endforeach
                    
            @endif      
            <div class="row">
                <div class="col-xs-2 col-sm-4">
                </div>
                <div class="col-xs-8 col-sm-3">
                    {{--
                    <picture>
                        <!--<source media="(min-width: 700px)" srcset="http://www.ingema-sa.com/caliso/imagenes/cabezoteg.jpg">-->
                        <img id="elef" class="img-responsive center-block" src="{{ url('/imagenes/logo.jpg') }}">
                    </picture>
                    --}}
                    <h1>EFIPLUS</h1>
                </div>
                <div class="col-xs-2 col-sm-5">
                </div>
                <div class="clearfix"></div>
                <div class="hidden-xs col-sm-4">
                </div>        
                <div class="col-xs-12 col-sm-3">
                    <form method="post" class="hijo">
                        <div class="form-group">
                            <label class="sr-only" for="user">Usuario</label>
                            <input type="text" class="form-control" name="user" id="user"  placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="clave">Clave</label>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Clave">
                        </div>       
                        <hr class="hr-dark">    
                        <p class="text-center"><input type="submit" class="btn btn-primary btn-md" name="boton" id="boton" value="Enviar"></p>
                    </form>
                </div>
                <div class="hidden-xs col-sm-5">
                </div>  
                <div class="clearfix"></div>        
            </div>
        </div>      
    </form>
@endsection