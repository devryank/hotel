<x-app-layout>
    <x-slot name="css">
        <!-- DataTables -->
        <link rel="stylesheet"
              href="{{asset('dash/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    </x-slot>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Booking</h1>
                    </div>
                    @if (Auth::id() != '1')
                    <div class="col-6 text-right">
                        <a href="{{ route('dashboard.service.create') }}"
                           class="btn btn-primary">Tambah</a>
                    </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                {{ Session::get('success') }}
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <table id="example1"
                           class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No Kamar</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            @if (Auth::id() == 1 OR $service->room == Auth::user()->name)
                            <tr>
                                <td>{{ $service->room }}</td>
                                <td>{{ $service->service }}</td>
                                <td>
                                    @if ($service->status == '0')
                                    Belum selesai
                                    @else
                                    Selesai
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('dashboard.service.clear', $service->id) }}"
                                              method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="btn btn-info btn-sm mr-1"><i
                                                   class="fas fa-check"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <x-slot name="js">
        <!-- DataTables -->
        <script src="{{asset('dash/plugins/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('dash/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
        <script>
            $(function () {
          $("#example1").DataTable();
        });
        </script>
    </x-slot>
</x-app-layout>