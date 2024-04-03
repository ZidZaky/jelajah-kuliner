@extends('layouts.layout')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/register.css">
@endsection

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Register</h5>
                <form>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label">Phone number</label>
                        <input type="tel" class="form-control" id="inputPhone" placeholder="123-456-7890">
                    </div>
                    <div class="mb-3">
                        <label for="inputFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder="John">
                    </div>
                    <div class="mb-3">
                        <label for="inputLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="inputLastName" placeholder="Doe">
                    </div>
                    <div class="mb-3">
                        <label for="inputDOB" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="inputDOB">
                    </div>
                    <div class="mb-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="123 Main St">
                    </div>
                    <div class="mb-3">
                        <label for="inputCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="mb-3">
                        <label for="inputState" class="form-label">State</label>
                        <input type="text" class="form-control" id="inputState">
                    </div>
                    <div class="mb-3">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
