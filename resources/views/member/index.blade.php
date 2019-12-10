@extends('layouts.app')
@section('content')
  <div class="container-fluid mt-5 ">
    <div class="row">
        <div class="col"> 
          <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Member</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add Member</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="col-12">
                @if (session('status'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">NIA</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Angkatan</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Kontak</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="...">
              </nav>
            </div>
          </div>
      </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection