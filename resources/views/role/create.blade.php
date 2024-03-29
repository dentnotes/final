@extends('layouts.app')
@section('content')
    <div class="mb-2">
        <!-- Button to go back to the previous page -->
        <button onclick="window.history.back();" class="btn btn-warning"><span class="bi bi-arrow-return-left"></span>
            Go Back
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Basic Information</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('role.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                               name="name" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
