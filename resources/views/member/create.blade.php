@extends('layouts.app')
@section('content')
  <div class="container-fluid mt-5 ">
    <div class="row">
        <div class="col-xl-12 order-xl-1"> 
          <div class="card shadow">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Member</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('member.index') }}" class="btn btn-sm btn-primary">Back to list</a>
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
              <form>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3 col-12">
                      <label for="name" class="form-control-label">Nama Lengkap</label>
                    </div>
                    <div class="col-md-9 col-12">
                      <input class="form-control" type="text" name="name" id="name" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3 col-12">
                      <label for="gender" class="form-control-label">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-9 col-12">
                      <select class="form-control" name="gender" id="gender">
                        <option></option>
                        <option value="male">Laki - laki</option>
                        <option value="female">Perempuan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form mb-3">
                  <div class="row">
                    <div class="col-md-3 col-12">
                      <label class="form-control-label">Tempat,Tanggal Lahir</label>
                    </div>
                    <div class="col-md-4 col-12 mb-2">
                      <input class="form-control" type="text" name="place_of_birth">
                    </div>
                    <div class="col-md-5 col-12 mb-2">
                      <input class="form-control" type="date" name="date_of_birth">
                    </div>
                  </div>
                </div>
                <div class="form mb-3">
                  <div class="row mt--2">
                    <div class="col-md-3 col-12">
                      <label class="form-control-label">Alamat</label>
                    </div>
                    <div class="col-md-9 col-12">
                      <div class="row">
                        <div class="col-md-4 col-12 mb-2">
                          <select class="form-control" name="city">
                            <option>--- Select Kabupaten ----</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                          <select class="form-control" name="districts">
                            <option>--- Select Kecamatan ----</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                          <select class="form-control" name="village">
                            <option>--- Select Desa ----</option>
                          </select>
                        </div>
                        <div class="col-md-12 col-12">
                          <textarea class="form-control" name="address" rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection
@push('js')
  <script>
    var token = function() {
      var tmp = null;
      $.ajax({
        'async': false,
        'type': "get",
        'global': false,
        'dataType': 'json',
        'url': 'https://x.rajaapi.com/poe',
        'success': function(data) {
            tmp = data.token;
        }
      });
      return tmp;
    }();
    function getToken(){
      fetch('https://x.rajaapi.com/poe')
        .then((res)=>{
          res = res.json()
          console.log(res)
        })
    }
    
    getToken()
    async function getCity(){
      try{
        const res = await fetch(`https://x.rajaapi.com/MeP7c5ne${token}/m/wilayah/kabupaten?idpropinsi=33`)
        const cities = await res.json()
        cities.data.forEach((city) => {
          document.querySelector('[name=city]').innerHTML +=
          ` <option id="${city.id}" value="${city.name}">${city.name}</option>`
        })
      }catch(err){
        console.log(err)
      }
    }
    getCity()

    async function getDistricts(id){
      try{
        const res = await fetch(`https://x.rajaapi.com/MeP7c5ne${token}/m/wilayah/kecamatan?idkabupaten=${id}`)
        const districts = await res.json()
        document.querySelector('[name=districts]').innerHTML = ' '
        districts.data.forEach( (district) => {
          document.querySelector('[name=districts]').innerHTML +=
          ` <option id="${district.id}" value="${district.name}">${district.name}</option>`
        })
      }catch(error){
        console.log(error)
      }
    }

    const btnGetCity = document.querySelector('[name=city]')
    btnGetCity.addEventListener('change', () => {
      var id
      let value = document.querySelector('[name=city]').value
      let listNodeCity = document.querySelectorAll('[name=city] option')
      for(i = 0; i< listNodeCity.length; i++){
        if(value == listNodeCity[i].value){
          id = listNodeCity[i].id
          break;
        }
      }
      getDistricts(id)
    })

    async function getVillage(id){
      try{
        const res = await fetch(`https://x.rajaapi.com/MeP7c5ne${token}/m/wilayah/kelurahan?idkecamatan=${id}`)
        const village = await res.json()
        console.log(village)
        document.querySelector('[name=village]').innerHTML = 0
        village.data.forEach( (vlg) => {
          document.querySelector('[name=village]').innerHTML +=
          ` <option id="${vlg.id}" value="${vlg.name}">${vlg.name}</option>`
        })
      }catch(error){
        console.log(error)
      }
    }

    const btnGetDistrict = document.querySelector('[name=districts]')
    btnGetDistrict.addEventListener('change', () => {
      var id
      let value = document.querySelector('[name=districts]').value
      let listNodedistricts = document.querySelectorAll('[name=districts] option')
      for(i = 0; i< listNodedistricts.length; i++){
        if(value == listNodedistricts[i].value){
          id = listNodedistricts[i].id
          break;
        }
      }
      getVillage(id)
    })
  </script>
@endpush