
@extends('layout.master')

@section('content')

 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Recycle - Portal Leads</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Recycle Leads</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            @if(session()->has('message'))
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-check-all me-2"></i>
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif


                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title-desc"></p>
                                        @if (Auth::user()->user_type == '1')

                                            @include('property_lead.recycle_search')

                                            <div class="table-rep-plugin">
                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                    <table id="tech-companies-1" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Ref Number</th>
                                                                <th>Full Name</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Portal Name</th>
                                                                <th>Inquiry</th>
                                                                <th>Agent Feedback</th>
                                                                <th>Agent Name</th>
                                                                <th>Modifier</th>
                                                                <th>Last Updated</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>



                                                        <tbody>
                                                            @foreach ($leads as $lead)
                                                                <tr>
                                                                    <td>{{$lead->ref_no}}</td>
                                                                    <td>{{ Str::limit($lead->name, 15) }}</td>
                                                                    <td>{{ Str::limit($lead->email, 15) }}</td>
                                                                    <td>{{$lead->phone}}</td>

                                                                    <td>
                                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $lead->id }}">
                                                                        @if ($lead->from == 'no-reply23@email.dubizzle.com')
                                                                            Dubbizle
                                                                        @elseif ($lead->from == 'no-reply@propertyfinder.ae')
                                                                            Property finder
                                                                        @elseif ($lead->from == 'noreply@bayut.com')
                                                                            Bayut
                                                                        @endif
                                                                        </a>

                                                                    </td>

                                                                    <td>{{ Str::limit($lead->inquiry, 18) }}</td>
                                                                    <td>{{ Str::limit(@$lead->lead_detailss->lead_description, 18) }}</td>
                                                                    <td>

                                                                        <img class="rounded-circle avatar-xs" src="{{URL::asset('public/assets/images/users/'.@$lead->users->image)}}" alt="">
                                                                        {{ Str::limit(@$lead->users->name, 15) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Str::limit(@$lead->userss->name, 15) }}
                                                                    </td>
                                                                    <td>
                                                                        {{$lead->updated_at}}
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{url('property_listing/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm Transfer" title="Details">
                                                                            <i class="fas fa-eye"> </i>
                                                                        </a>
                                                                        <a href="{{url('property_listing_leads/transfer/'.$lead->id)}}" class="btn btn-outline-secondary btn-sm Transfer" title="Transfer">
                                                                            <i class="fas fa-sync"> </i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @else
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                    <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Reference Number</th>

                                                        <th>Inquiry</th>
                                                        <th>Last Update</th>

                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                        @foreach ($leads as $lead)
                                                            <tr>
                                                                <td>{{$lead->ref_no}}</td>

                                                                <td>{{$lead->inquiry}}</td>
                                                                <td>{{@$lead->lead_detailss->lead_description}}</td>




                                                                <td>
                                                                <a href="{{url('property_listing_leads/transfer/'.$lead->id)}}" class="btn btn-outline-info btn-sm Transfer" title="Transfer">
                                                                    <i class="fas fa-sync"> </i>
                                                                </a>

                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>


                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Edge Realty.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Edge Realty
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->


@endsection
