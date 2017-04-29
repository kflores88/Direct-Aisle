@extends('layouts.app')

@section('content')
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">       
                <div class="panel-heading"><center><h3>Manage Shopping List</h3></center></div><!-- Star of panel-heading -->
                <div align="center" class="panel-body"><!-- Star of panel-body-->
                    <!--Add table -->
                    <table class="table table-striped task-table">
                    <thead>
                        <th>ID</th> 
                        <th>NAME</th>
                        <th>DATE</th>
                    </thead>
                    <!--Creating the body-->
                    <tbody>
                        <!--space for the foreach loop-->
                        @foreach($lists as $key => $value)
                            <tr>
                                <!--Task name-->
                                <td>{{$value->list_id}}</td>
                                <td>{{$value->list_name}}</td>
                                <td>{{$value->created_at}}</td>
                               <td>
                               <form action="manageLists/{{$value->list_id}}" method="delete" >
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="hidden" name="_method" value="delete">
                    
                                    <!--Delete/Destroy button-->
                                    <div align="left">
                                        <input type="submit" class="btn btn-danger" value="delete" class="fa fa-plus">
                                    </div>
                                </td>
                                </tr>
                                </form>    
                    @endforeach

                    </tbody>
                    <!--  -->
                    </table>

                    <form action="manageLists/create" method="get">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div align="center"><br>
                            <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i>Create A List
                            </button>
                            </div>
                            </form>
                        </div><!-- End of panel-body -->
                </div><!-- End of panel-heading -->
            </div>
        </div>
</div>


<!-- Start of new  -->
<hr>
@endsection