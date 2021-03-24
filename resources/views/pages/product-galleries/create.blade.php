@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Foto Barang</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{route('product-galleries.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Nama Barang</label>
                    <select name="products_id" class="form-control">
                        @foreach($product as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                    @error('products_id') <div class="text-muted @error('products_id') is-invalid @enderror">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="form-control-label">Foto Barang</label>
                    <input type="file" name="photo" value="{{old('photo')}}"
                           accept="image/*"
                           class="form-control @error('photo') is-invalid @enderror"/>
                    @error('photo') <div class="text-muted">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="is_default" class="form-control-label">Jadikan Default</label>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_default" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Ya
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_default" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                            Tidak
                        </label>
                    </div>

                    @error('is_default') <div class="text-muted">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Tambah Foto Barang</button>
                </div>
            </form>
        </div>
    </div>
@endsection
