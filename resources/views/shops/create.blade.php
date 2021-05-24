@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Register New Shop</h1>

        <div class="mt-5 row justify-content-center">
            <form
                class="col-md-9 col-xs-12 card card-body"
            >
                <fieldset class="border p-4">
                    <legend class="text-primary">Name, Category and Main Image</legend>

                    <div class="form-group">
                        <label for="name">Name of the Shop</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Name of the Shop"
                            name="name"
                            value="{{old('name')}}"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>   
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>

                        <select 
                            class="form-control @error('category_id') is-invalid @enderror"
                            name="category_id"
                            id="category"    
                        >
                            <option value="" selected disabled>--Select a Category--</option>

                            @foreach($categories as $category)
                                <option 
                                    value="{{$category->id}}"
                                    {{old('category_id') == $category->id ? 'selected' : ''}}>
                                        {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="main_image">Image</label>
                        <input
                            id="main_image"
                            type="file"
                            class="form-control @error('main_image') is-invalid @enderror"
                            name="main_image"
                            value="{{old('main_image')}}"
                        >

                        @error('main_image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>   
                        @enderror
                    </div>


                </fieldset>

                <fieldset class="border p-4">
                    <legend class="text-primary">Ubicacion</legend>

                    <div class="form-group">
                        <label for="address">Address of the Shop</label>
                        <input
                            id="address"
                            type="text"
                            placeholder="Address of the Shop"
                            class="form-control"
                        >
                        <p class="text-secondary mt- mb-3 text-center">The assist will put a stimate address, move the pointer to the right place, please </p>
                    </div>

                    <div class="form-group">
                        <div id="mapa" style="height:400px"></div>
                    </div>

                    <p class="info">Confirm that the next field are correct</p>

                    <div class="form-group">
                        <label for="address">Address</label>

                        <input
                            type="text"
                            id="address"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="address"
                            value="{{old('address')}}"
                        >
                        @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>   
                        @enderror
                    </div>

                    <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
                    <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">
                </fieldset>

            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

@endsection