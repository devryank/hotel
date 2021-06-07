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
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.booking.store') }}"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jumlah Orang</label>
                                    <input type="number"
                                           name="amount"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <select name="bed"
                                            class="form-control">
                                        <option value="1">Single Bed</option>
                                        <option value="2">Double Bed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Awal</label>
                                    <input type="date"
                                           name="start_date"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date"
                                           name="end_date"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <input type="submit"
                               value="Booking"
                               class="btn btn-primary">
                    </form>
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