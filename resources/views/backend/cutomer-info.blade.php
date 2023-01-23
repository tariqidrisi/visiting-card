@extends('layouts.backend')

@section('style')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <style>
        .editable-popup{top:-61px !important;left:245px !important;}
    </style>
@endsection

@section('content')
    <div class="content">
        <a href="{{ url("/new-customer-info")  }}" class="pb-5"><i class="nc-icon nc-simple-add"></i>Add Info</a>
        <table id="customer" class="table table-striped table-bordered mt-5" style="width:100%">
            <thead>
            <tr>
                <th>Username</th>
                <th>Owner</th>
                <th>Email</th>
                <th>Address</th>
{{--                <th>From Day</th>--}}
{{--                <th>To Day</th>--}}
{{--                <th>From Time</th>--}}
{{--                <th>To Time</th>--}}
{{--                <th>Closed</th>--}}
                <th>Opening Hours</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>
                            {{$row->company->company}}
                        </td>

                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="owner">
                                {{$row->owner}}</a>
                        </td>

                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="email">
                                {{$row->email}}</a>
                        </td>

                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="address">
                                {{$row->address}}</a>
                        </td>
{{--                        <td>--}}
{{--                            <a href="#" class="xedit"--}}
{{--                               data-pk="{{$row->id}}"--}}
{{--                               data-name="from_day">--}}
{{--                                {{$row->from_day}}</a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a href="#" class="xedit"--}}
{{--                               data-pk="{{$row->id}}"--}}
{{--                               data-name="to_day">--}}
{{--                                {{$row->to_day}}</a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a href="#" class="xedit"--}}
{{--                               data-pk="{{$row->id}}"--}}
{{--                               data-name="from_time">--}}
{{--                                {{$row->from_time}}</a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a href="#" class="xedit"--}}
{{--                               data-pk="{{$row->id}}"--}}
{{--                               data-name="to_time">--}}
{{--                                {{$row->to_time}}</a>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            @foreach($row->closed as $closedOn)--}}
{{--                                {{ $closedOn  }}--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <a href="#" class="xedit"--}}
{{--                               data-pk="{{$row->id}}"--}}
{{--                               data-name="closed">--}}
{{--                                {{$row->closed}}</a>--}}
{{--                        </td>--}}
                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="opening_hours">
                                {{$row->opening_hours}}</a>
                        </td>
                        <td>
                            <a href="{{ url("/customer-information/$row->id") }}" class="cursor-pointer mr-4"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a class="delete-confirm" onclick="deleteRecord({{ $row->id  }})" href="#"
                               role="button"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Company</th>
                <th>Owner</th>
                <th>Email</th>
                <th>Address</th>
{{--                <th>From Day</th>--}}
{{--                <th>To Day</th>--}}
{{--                <th>From Time</th>--}}
{{--                <th>To Time</th>--}}
{{--                <th>Closed</th>--}}
                <th>Opening Hours</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#customer').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $('.xedit').editable({
                mode: 'inline',
                url: '{{url("ajax-update-customer")}}',
                title: 'Update',
                success: function (response, newValue) {
                    console.log('Updated', response)
                }
            });

        })
    </script>
@endsection
