@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Register New Shop</h1>

        <div class="mt-5 row justify-content-center">
            <form
                class="col-md-9 col-xs-12 card card-body"
            >
                <fieldset class="border p-4">
                    <legend class="text-primary">Name and Category</legend>

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
                </fieldset>

            </form>
        </div>
    </div>
@endsection