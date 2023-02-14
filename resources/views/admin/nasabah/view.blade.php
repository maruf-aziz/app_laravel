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

        @can('nasabah-create')
            <a href="{{ route('nasabah.create') }}" class="btn btn-primary mb-2 li-modal"><i>+</i> Tambah Data</a>
        @endcan

        <a href="{{ url('generate-pdf') }}" class="btn btn-warning">Print</a>

        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telp</th>
                    <th scope="col">Alamat</th>
                    @if (Gate::check('nasabah-edit') || Gate::check('nasabah-delete'))
                        <th scope="col">Aksi</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($data as $key => $item)
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
                        @if (Gate::check('nasabah-edit') || Gate::check('nasabah-delete'))
                        <td>

                            @can('nasabah-edit')
                            <a href="{{ route('nasabah.edit', $item->id) }}" class="btn btn-success li-modal">Edit</a>
                            @endcan

                            @can('nasabah-delete')
                            <form action="{{ route('nasabah.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda Yakin?')">Delete</button>
                            </form>
                            @endcan
                        </td>
                        @endif
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
                @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('nasabah.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });

        $('.li-modal').on('click', function(e) {
            e.preventDefault();
            $('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
        });
    </script>
@endsection
