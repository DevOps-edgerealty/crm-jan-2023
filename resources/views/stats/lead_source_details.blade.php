
@extends('layout.master')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">







            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3>
                            Details of Lead Source
                        </h3>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Statistics</li>
                                <li class="breadcrumb-item active">Overview</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->




            {{-- Menu-bar --}}
            @include('stats.menu_bar')
            {{-- /Menu-bar --}}






            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap align-middle mb-0 table-hover">
                                                        <thead class="shadow-sm">
                                                            <tr>
                                                                <th scope="col" class="text-center">Id</th>
                                                                <th scope="col" class="text-center">Agent Name</th>
                                                                <th scope="col" class="text-center">Lead Source</th>
                                                                <th scope="col" class="text-center">Sale Value</th>
                                                                <th scope="col" class="text-center">Rent Value</th>
                                                                <th scope="col" class="text-center">Net Commission</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($leader_board as $data => $value)
                                                                <tr class='clickable-row' data-href='url://link-for-first-row/'>
                                                                    <td class="text-center">
                                                                        <div class="text-muted">
                                                                            {{$value->id}}
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="text-muted">
                                                                            @foreach($all_leaders as $data)
                                                                                @if ($data->id === $value->leader_id)
                                                                                    {{$data->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="text-muted">
                                                                            {{$value->lead_source}}
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="text-muted">
                                                                            @if(!empty($value->sale_value))
                                                                                {{$value->sale_value}}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="text-muted">
                                                                            @if(!empty($value->rent_value))
                                                                                {{$value->rent_value}}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <div class="text-muted">
                                                                            @if(!empty($value->rent_value))
                                                                                {{$value->net_commission}}

                                                                            @elseif(!empty($value->sale_value))
                                                                                {{$value->net_commission}}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div><!--end card-->
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
