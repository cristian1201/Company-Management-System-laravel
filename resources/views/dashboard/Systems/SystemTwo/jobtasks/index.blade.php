@section('title')
    {{__('Systems/SystemTwo/jobtasks.jobtasks')}}
@endsection
@extends('dashboard.layouts.layout')
@section('style')

<link href="{{ asset('assets/dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('assets/dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    td { text-align: center; }
</style>

<link href="{{ asset('assets/dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('rightbar-content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">{{__('Systems/SystemTwo/jobtasks.jobtask_list')}}</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('side.dashboard') }}</a></li>
                    <li class="breadcrumb-item">{{__('Systems/SystemTwo/jobtasks.jobtasks')}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Systems/SystemTwo/jobtasks.jobtask_list')}}</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="{{ route('jobtasks.create') }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>{{__('Systems/SystemTwo/jobtasks.add_jobtask')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="default-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.employee')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.job_name')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.job_type')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.job_task_date')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.job_number_days')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.status')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.job_note')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.detail')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.edit')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.report')}}</th>
                                    <th>{{__('Systems/SystemTwo/jobtasks.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($jobtasks) && count($jobtasks) > 0)
                                    @foreach($jobtasks as $key => $jobtask)
                                        <tr>

                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $jobtask->employee }}</td>
                                        <td>{{ $jobtask->job_name }}</td>
                                        <td>{{ $jobtask->job_type }}</td>
                                        <td>{{ $jobtask->job_task_date }}</td>
                                        <td>{{ $jobtask->job_number_days }}</td>
                                        <td>{{ $jobtask->status }}</td>
                                        {{--<td>--}}

                        {{--<div class="custom-control custom-switch" >--}}
                        {{--<input type="checkbox" onclick="status_change('{{csrf_token()}}','{{$jobtask->id}}','{{url('jobtask-status')}} ')" {{ $jobtask->status == 1?'checked':''}} class="custom-control-input" id="customSwitch{{$key}}">--}}
                        {{--<label class="custom-control-label" for="customSwitch{{$key}}"></label>--}}
                              {{--</div>--}}

                                        {{--</td>--}}
                                            <td>
                                                <a onclick="noteShow('{{$jobtask->job_note}}')" data-toggle="modal" data-target="#noteShow" class="btn btn-info-rgba"><i class="feather icon-tag"></i></a>
                                            </td>
                                            <td><a href="{{url('dashboard/detail-jobtask')}}/{{ $jobtask->id }}" class="btn btn-info-rgba"><i class="feather icon-eye"></i></a></td>
                                            <td><a href="{{route('jobtasks.edit', $jobtask->id)}}" class="btn btn-success-rgba"><i class="feather icon-edit-2"></i></a></td>
                                            <td><a href="{{url('dashboard/report-jobtask')}}/{{ $jobtask->id }}" class="btn btn-success-rgba"><i class="feather icon-download"></i></a></td>
                                            {{--<td><a onclick="return confirm('Are you sure?')" href="{{url('dashboard/del-jobtask')}}/{{ $jobtask->id }}" class="btn btn-danger-rgba"><i class="feather icon-trash"></i></a></td>--}}
                                            <td><a onclick="deleteConfirm({{ $jobtask->id }})" href="#" class="btn btn-danger-rgba"><i class="feather icon-trash"></i></a></td>
                                      </tr>
                                    @endforeach
                                    @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>

<!-- The Jobtask Note Modal -->
<div class="modal fade" id="noteShow" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('Systems/SystemTwo/jobtasks.job_note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="jobnote" name="jobnote" style="width:100%;height:200px;" readonly></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- End Contentbar -->
@endsection
@section('script')
<script>

    function status_change(token, id, route) {
        $.ajax({
            url : route,
            type: "POST",
            data: {_token: token, id: id},
            success: function (response) {
                //$(".table").load(location.href + " .table>*", "");
            }
        });
    }
</script>

<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/dashboard/js/custom/custom-toasts.js') }}"></script>

<!-- Sweet-Alert js -->
<script src="{{ asset('assets/dashboard/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/custom/custom-sweet-alert.js') }}"></script>

<script>
    $(document).ready(function() {

        var buttonCommon = {
            exportOptions: {
                format: {
                    body: function ( data, row, column, node ) {
                        // Strip $ from salary column to make it numeric
                        console.log(row);
                        if(row === 4){
                            return $('#customSwitch' + column).is(":checked") ? 'Active' : 'Inactive' ;
                        }
                        return data;
                    }
                },
                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            }
        };

        $('#default-datatable').DataTable(
            {
                dom: 'Bfrtip',
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'print',
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'csvHtml5',
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    } ),
                ]
            }
        );

    });

    function noteShow(jobnote) {

        document.getElementById("jobnote").innerHTML = jobnote;
        return true;
    }
</script>
<script>
    function deleteConfirm(id) {

        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                method: "post",
                url: "{{url('dashboard/del-jobtask')}}",
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                },

                data : JSON.stringify({id : id}),
                datatype: 'JSON',
                contentType: 'application/json',

                async: true,
                success: function (data) {
                    console.log(data);
                    //  wait.resolve();
                    $(".loadingMask").css('display', 'none');

                    if (data === 0) {
                        swal(
                            'Error',
                            'Please try again',
                            'error'
                        )
                    } else {
                        swal(
                            'Done!',
                            'Deleted Successfully',
                            'success'
                        ).then(function (){
                            window.location = "{{route('jobtasks.index')}}"
                        });
                    }
                },
                error: function () {
                    swal(
                        'Error',
                        'Please try again',
                        'error'
                    )
                }
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your jobtask data is safe :)',
                    'error'
                )
            }
        })

    }

</script>
@endsection
