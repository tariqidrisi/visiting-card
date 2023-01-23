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
        <a href="{{ url("/new-company")  }}" class="pb-5"><i class="nc-icon nc-simple-add"></i>New Card</a>
        <table id="company" class="table table-striped table-bordered mt-5" style="width:100%">
            <thead>
            <tr>
                <th>Company</th>
                <th>Theme</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="company">
                                {{$row->company}}</a>
                        </td>

                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="theme">
                                {{$row->theme}}</a>
                        </td>

                        <td>
                            <a href="#" class="xedit"
                               data-pk="{{$row->id}}"
                               data-name="desc">
                                {{$row->desc}}</a>
                        </td>
                        <td>
                            <a href="{{ url("/company/$row->id") }}" class="cursor-pointer mr-4"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a class="delete-confirm" onclick="deleteRecord({{ $row->id  }})" href="#"
                               role="button"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Company</th>
                <th>Theme</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#company').DataTable();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $('.xedit').editable({
                mode: 'inline',
                url: '{{url("ajax-update-company")}}',
                title: 'Update',
                success: function (response, newValue) {
                    console.log('Updated', response)
                }
            });

        })
    </script>
@endsection
