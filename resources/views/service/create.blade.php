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
                        <h1>Service</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.service.store') }}"
                          method="post">
                        @csrf
                        <div class="row">
                            <label>Service</label>
                            <textarea name="service"
                                      cols="30"
                                      rows="5"
                                      class="form-control"></textarea>

                            <input type="submit"
                                   value="Buat Permintaan"
                                   class="btn btn-primary mt-2">
                        </div>
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