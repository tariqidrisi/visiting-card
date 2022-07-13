@extends('layouts.backend')

@section('style')
    <style>
        .table-sortable tbody tr {
            cursor: move;
        }
        label {
            vertical-align: sub;
        }
        button[type=submit] {
            font-size: 16px !important;
            padding: 0 30px;
            height: 39px;
        }
    </style>
@endsection

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('company-social-media')  }}">
            @csrf
            <div class="row mb-5">
                <div class="col-md-1">
                    <label>Company</label>
                </div>
                <div class="col-md-11">
                    <select name="company_id" class="form-control w-50 companies">
                        <option></option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id  }}" @if(isset($id) && $company->id == $id) selected @endif>{{ $company->company }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                        <thead>
                        <tr >
                            <th class="text-center">
                                Social Media
                            </th>
                            <th class="text-center">
                                Links
                            </th>
                            <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($data))

                            @php
                                $count = 0
                            @endphp
                            @foreach($data as $key => $row)
                            <tr id='addr{{$count}}' data-id="{{$count}}" class="hidden">
                                <td data-name="sel">
                                    <select name="sel{{$count}}" class="w-100 social-media" id="">
                                        <option value="">Select</option>
                                        <option value="website" @if($key == 'website') selected @endif>Website</option>
                                        <option value="facebook" @if($key == 'facebook') selected @endif>Facebook</option>
                                        <option value="instagram" @if($key == 'instagram') selected @endif>Instagram</option>
                                        <option value="whatsapp" @if($key == 'whatsapp') selected @endif>Whatsapp</option>
                                        <option value="linkedin" @if($key == 'linkedin') selected @endif>Linkedin</option>
                                        <option value="twitter" @if($key == 'twitter') selected @endif>Twittter</option>
                                        <option value="youtube" @if($key == 'youtube') selected @endif>Youtube</option>
                                        <option value="email" @if($key == 'email') selected @endif>Email</option>
                                        <option value="portfolio" @if($key == 'portfolio') selected @endif>Portfolio</option>
                                        <option value="pricing" @if($key == 'pricing') selected @endif>Pricing</option>
                                    </select>
                                </td>
                                <td data-name="name">
                                    <input type="text" name='name{{$count}}'  placeholder='Insert/Paste Link here' value="{{ $row }}" class="form-control social-media-value"/>
                                </td>
                                <td data-name="social-media"><input type="hidden" name="{{$key}}" class="selected-social-media" value="{{ $row }}" /></td>
                                <td data-name="del">
                                    <a name="del{{$count}}" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></a>
                                </td>
                            </tr>
                                @php
                                    $count++;
                                @endphp
                            @endforeach

                        @else

                            <tr id='addr0' data-id="0" class="hidden">
                                <td data-name="sel">
                                    <select name="sel0" class="w-100 social-media" id="">
                                        <option value="">Select</option>
                                        <option value="website">Website</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="whatsapp">Whatsapp</option>
                                        <option value="linkedin">Linkedin</option>
                                        <option value="twitter">Twitter</option>
                                        <option value="youtube">Youtube</option>
                                        <option value="email">Email</option>
                                        <option value="portfolio">Portfolio</option>
                                        <option value="pricing">Pricing</option>
                                    </select>
                                </td>
                                <td data-name="name">
                                    <input type="text" name='name0'  placeholder='Insert/Paste Link here' class="form-control social-media-value"/>
                                </td>
                                <td data-name="social-media" class="hiddenVal"><input type="hidden" name="social-media0" class="selected-social-media" value="" /></td>
                                <td data-name="del">
                                    <a name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></a>
                                </td>
                            </tr>

                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <a id="add_row" class="btn btn-primary float-right">Add Row</a>
            <button type="submit" class="btn bg-success text-white btn-round">Submit</button>
        </form>

    </div>
@endsection

@section('js')
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <script>

        $(document).ready(function() {

            $('body').on("change", '.social-media', function () {
                $(this).parent().parent().find('input[type="hidden"]:first').attr("name",$(this).val());
            })

            $('body').on("keyup", '.social-media-value', function () {
                $(this).parent().parent().find('input[type="hidden"]:first').val($(this).val());
            })

            $(".companies").change(function () {
                var company_id = $(this).val();
                var url = '/social-media/'+ company_id;

                $.ajax({
                    url: url,
                    type: "get",
                    success: function (response) {

                        $("body").html(response);
                        $("#social-media").addClass("active")
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            })

            $("#add_row").on("click", function() {
                // Dynamic Rows Code

                // Get max row id and set new id
                var newid = 0;
                $.each($("#tab_logic tr"), function() {
                    if (parseInt($(this).data("id")) > newid) {
                        newid = parseInt($(this).data("id"));
                    }
                });
                newid++;

                var tr = $("<tr></tr>", {
                    id: "addr"+newid,
                    "data-id": newid
                });

                // loop through each td and create new elements with name of newid
                $.each($("#tab_logic tbody tr:nth(0) td"), function() {
                    var td;
                    var cur_td = $(this);

                    var children = cur_td.children();

                    // add new td and element if it has a nane
                    if ($(this).data("name") !== undefined) {
                        td = $("<td></td>", {
                            "data-name": $(cur_td).data("name")
                        });

                        var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                        c.attr("name", $(cur_td).data("name") + newid);
                        c.appendTo($(td));
                        td.appendTo($(tr));
                    } else {
                        td = $("<td></td>", {
                            'text': $('#tab_logic tr').length
                        }).appendTo($(tr));
                    }
                });

                // add delete button and td
                /*
                $("<td></td>").append(
                    $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                        .click(function() {
                            $(this).closest("tr").remove();
                        })
                ).appendTo($(tr));
                */

                // add the new row
                $(tr).appendTo($('#tab_logic'));

                $(tr).find("td .row-remove").on("click", function() {
                    $(this).closest("tr").remove();
                });
            });




            // Sortable Code
            var fixHelperModified = function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();

                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width())
                });

                return $helper;
            };

            $(".table-sortable tbody").sortable({
                helper: fixHelperModified
            }).disableSelection();

            $(".table-sortable thead").disableSelection();



            $("#add_row").trigger("click");
        });

    </script>
@endsection
