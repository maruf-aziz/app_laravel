@extends('layout.app')

@section('content')
    <div class="content mt-3">

        <div class="card">
            <div class="card-header">
                Add Nasabah
            </div>
            <div class="card-body">
                {{-- <form action="{{ url('nasabah') }}" method="POST" novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                        @error('nama_lengkap')
                            <div class="valid-feedback">
                                akhskah
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Telp</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota Utama</label>
                                <input type="text" class="form-control" name="kota[]" id="kota">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Utama</label>
                                <textarea class="form-control" name="alamat[]" id="alamat" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="kota[]" class="form-label">Kota Lain</label>
                                <input type="text" class="form-control" name="kota[]" id="kota[]">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat lain</label>
                                <textarea class="form-control" name="alamat[]" id="alamat" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form> --}}

                {{ Form::model($get_nasabah, ['route' => ['nasabah.update', $get_nasabah->id], 'method' => 'PUT']) }}

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="mb-3">
                    {{ Form::label('nama_lengkap', 'Nama Lengkap', ['class' => 'form-label']) }}
                    {{ Form::text('nama_lengkap', null, ['class' => 'form-control', 'id' => 'nama_lengkap']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('email', 'Email', ['class' => 'form-label']) }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) }}
                </div>
                <div class="mb-3">
                    {{ Form::label('no_telp', 'Nomor Telp', ['class' => 'form-label']) }}
                    {{ Form::text('no_telp', null, ['class' => 'form-control', 'id' => 'no_telp']) }}
                </div>
                <div class="row">

                    @php
                        $param = 0;
                    @endphp

                    @foreach (json_decode($get_nasabah->alamat) as $key => $item)
                        <div class="col-6">
                            <div class="mb-3">
                                {{ Form::label('kota', 'Nama Lengkap', ['class' => 'form-label']) }}
                                {{ Form::text('kota[]', $item->Kota, ['class' => 'form-control', 'id' => 'kota']) }}
                            </div>
                            <div class="mb-3">
                                {{ Form::label('alamat', 'Alamat', ['class' => 'form-label']) }}
                                {{ Form::text('alamat[]', $item->alamat, ['class' => 'form-control', 'id' => 'alamat']) }}
                            </div>
                        </div>
                        @php
                            $param += 1;
                        @endphp
                    @endforeach

                    @if ($param == 1)
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="kota[]" class="form-label">Kota Lain</label>
                                <input type="text" class="form-control" name="kota[]" id="kota[]">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat lain</label>
                                <textarea class="form-control" name="alamat[]" id="alamat" rows="3"></textarea>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>

                {{ Form::close() }}

            </div>
        </div>

    </div>
@endsection
