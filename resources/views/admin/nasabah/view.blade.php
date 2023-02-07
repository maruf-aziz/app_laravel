@extends('layout.app')

@section('content')
    <div class="content mt-3">

        <h2>{{ request()->segment(1) }}</h2>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('nasabah.create') }}" class="btn btn-primary mb-2 li-modal"><i>+</i> Tambah Data</a>
        {{-- <a href="{{ route('nasabah.create') }}" class="btn btn-primary mb-2"><i>+</i> Tambah Data</a> --}}

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop{{ $item->id }}">
                                Lihat Alamat
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('nasabah.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            {{-- <button class="btn btn-warning">Add emergency concat</button>
                            <button class="btn btn-info">Add Suami / Istri</button> --}}
                            <form action="{{ route('nasabah.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda Yakin?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Alamat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        @foreach (json_decode($item->alamat) as $val)
                                            <li>{{ $val->alamat . ' - ' . $val->Kota }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    
@endsection
