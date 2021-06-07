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
                    <div class="col-6 text-right">
                        <a href="{{ route('dashboard.booking.create') }}"
                           class="btn btn-primary">Tambah</a>
                    </div>
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
            @elseif(Session::get('warning'))
            <div class="alert alert-warning alert-dismissible fade show"
                 role="alert">
                {{ Session::get('warning') }}
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
                                <th>Mulai Booking</th>
                                <th>Akhir Booking</th>
                                <th>Harga</th>
                                <th>Lunas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->room }}</td>
                                <td>{{ $booking->start_date }}</td>
                                <td>{{ $booking->end_date }}</td>
                                <td>{{ "Rp" . number_format($booking->price,0,',','.') }}</td>
                                <td>
                                    @if ($booking->paid == '0')
                                    Belum Lunas
                                    @else
                                    Lunas
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('dashboard.booking.paid', $booking->id) }}"
                                              method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="btn btn-info btn-sm mr-1"><i
                                                   class="fas fa-check"></i></button>
                                        </form>
                                        <form action="{{ route('dashboard.booking.destroy', $booking->id) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
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