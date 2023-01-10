@extends('layout.master')

@section('content')
<style>
    .hide {
  display: none;
}
</style>


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
                                    <h4 class="mb-sm-0 font-size-18">Portals Listing Lead Details</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{URL('')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{URL('/property_listing')}}">Portals Listing Leads</a></li>
                                            <li class="breadcrumb-item active">Portals Listing Lead Details</li>
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

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Portals Listing Lead Details</h4>
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Refrence Number :</th>
                                                            <td>{{$leads->ref_no}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Inquiry</th>
                                                            <td>{{$leads->inquiry}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Portal</th>
                                                            <td>
                                                                @if ($leads->from == 'no-reply23@email.dubizzle.com')
                                                                    Dubbizle
                                                                @elseif ($leads->from == 'no-reply@propertyfinder.ae')
                                                                    Property finder
                                                                @elseif ($leads->from == 'noreply@bayut.com')
                                                                    Bayut
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Full Name :</th>
                                                            <td>{{$leads->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile :</th>
                                                            <td>{{$leads->phone}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">E-mail :</th>
                                                            <td>{{$leads->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Agent Name :</th>
                                                            <td>{{@$leads->users->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Location :</th>
                                                            <td>{{$leads->location}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Property Detail :</th>
                                                            <td>{{$leads->property_detail}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Property Location :</th>
                                                            <td>{{$leads->property_location}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Lead Status :</th>
                                                            <td>

                                                                @if (@$leads->lead_detailss->lead_status == '1')
                                                                    <span class="badge badge-pill badge-soft-success font-size-14">Inerested</span>
                                                                @elseif (@$leads->lead_detailss->lead_status == '2')
                                                                    <span class="badge badge-pill badge-soft-danger font-size-14">Not Inerested</span>
                                                                @elseif (@$leads->lead_detailss->lead_status == '3')
                                                                    <span class="badge badge-pill badge-soft-info font-size-14">No Answering</span>
                                                                @elseif (@$leads->lead_detailss->lead_status == '4')
                                                                    <span class="badge badge-pill badge-soft-primary font-size-14">Contacted</span>
                                                                @elseif (@$leads->lead_detailss->lead_status == '')
                                                                    <span class="badge badge-pill badge-soft-warning font-size-14">Not Contacted</span>
                                                                @elseif (@$leads->lead_detailss->lead_status == '6')
                                                                    <span class="badge badge-pill badge-soft-success font-size-14">Deal</span>
                                                                @endif
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="card-title mb-4">Lead Status</h4>
                                                <form method="POST" action="{{url('property_listing_leads/lead_change_status')}}" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="lead_id" value="{{$leads->id}}" >
                                                    <div class="row mb-4">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Change lead Status</label>
                                                        <div class="col-sm-9">
                                                            <select name="lead_status_type" class="form-select" required>
                                                                @if ($lead_status_type)
                                                                    @foreach ($lead_status_type as $lead_status_types)
                                                                        <option  {{ $lead_status_types->id == $leads->lead_status ? 'selected' : '' }} value="{{$lead_status_types->id}}">{{$lead_status_types->name}}</option>
                                                                    @endforeach
                                                                @endif

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-9">

                                                            <div>
                                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div> --}}




                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-6">

                                <div class="card">

                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Lead status</h4>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if (Auth::user()->user_type == '1')
                                                    @if (count($lead_detail) == 0 )

                                                        <select class="form-select div-toggle" data-target=".my-info-1">
                                                            <option value="notconnected" selected  data-show=".notconnected">Not Contacted</option>
                                                            <option value="notanswering"  data-show=".notanswering">Not Answering</option>
                                                            <option value="inprogress"  data-show=".inprogress">Intrested</option>
                                                            <option value="notinterested"  data-show=".notinterested">Not Intrested</option>
                                                            <option value="transferlead" data-show=".transferlead">Transfer Lead</option>
                                                            <option value="recyclelead" data-show=".recyclelead">Recycle Lead</option>
                                                            {{-- <option value="dealclosed" data-show=".dealclosed">Deal Closed</option> --}}
                                                        </select>
                                                    @else

                                                        <select class="form-select div-toggle" data-target=".my-info-1">
                                                            <option value="notconnected"  data-show=".notconnected">Not Contacted</option>
                                                            <option value="notanswering" {{ @$leads->lead_detailss->lead_status == 3 ? 'selected' : '' }}  data-show=".notanswering">Not Answering</option>
                                                            <option value="inprogress"  {{ @$leads->lead_detailss->lead_status == 1 ? 'selected' : '' }} data-show=".inprogress">Intrested</option>
                                                            <option value="notinterested" {{ @$leads->lead_detailss->lead_status == 2 ? 'selected' : '' }}  data-show=".notinterested">Not Intrested</option>
                                                            <option value="transferlead" data-show=".transferlead">Transfer Lead</option>
                                                            <option value="recyclelead" data-show=".recyclelead">Recycle Lead</option>
                                                            {{-- <option value="dealclosed" data-show=".dealclosed">Deal Closed</option> --}}
                                                        </select>
                                                    @endif
                                                @else
                                                    @if (count($lead_detail) == 0 )

                                                        <select class="form-select div-toggle" data-target=".my-info-1">
                                                            <option value="notconnected" selected  data-show=".notconnected">Not Contacted</option>
                                                            <option value="notanswering"  data-show=".notanswering">Not Answering</option>
                                                            <option value="inprogress"  data-show=".inprogress">Intrested</option>
                                                            <option value="notinterested"  data-show=".notinterested">Not Intrested</option>
                                                            <option value="transferlead" data-show=".transferlead">Transfer Lead</option>
                                                        </select>
                                                    @else

                                                        <select class="form-select div-toggle" data-target=".my-info-1">
                                                            <option value="notconnected"  data-show=".notconnected">Not Contacted</option>
                                                            <option value="notanswering" {{ @$leads->lead_detailss->lead_status == 3 ? 'selected' : '' }}  data-show=".notanswering">Not Answering</option>
                                                            <option value="inprogress"  {{ @$leads->lead_detailss->lead_status == 1 ? 'selected' : '' }} data-show=".inprogress">Intrested</option>
                                                            <option value="notinterested" {{ @$leads->lead_detailss->lead_status == 2 ? 'selected' : '' }}  data-show=".notinterested">Not Intrested</option>
                                                            <option value="transferlead" data-show=".transferlead">Transfer Lead</option>
                                                        </select>
                                                    @endif

                                                @endif










                                                <div class="my-info-1">
                                                <div class="notconnected hide"></div>
                                                <div class="notanswering hide">
                                                    <h4 class="card-title mt-4 mb-4">Lead Details Not Answering</h4>
                                                    <div class="table-rep-plugin mb-5">
                                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                        <table id="tech-companies-1" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <td>
                                                                        Agent Name
                                                                    </td>
                                                                    <td>
                                                                        Description
                                                                    </td>
                                                                    <td>
                                                                        Reminder Date
                                                                    </td>
                                                                    <td>
                                                                        Date
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                @if (!empty($lead_detail) )
                                                                    @foreach ($lead_detail as $lead)
                                                                        <tr>
                                                                            <td>{{@$lead->users->name}}</td>
                                                                            <td>{{@$lead->lead_description}}</td>
                                                                            <td>{{@$lead->reminder_date}}</td>
                                                                            <td>{{date('d-m-Y H:i:s', strtotime($lead->created_at));}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center">No Record Found</td>
                                                                    </tr>

                                                                @endif






                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    <form method="POST" action="{{url('leads/lead_store_detail')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="lead_status" value="3" >
                                                        <input type="hidden" name="lead_id" value="{{$leads->id}}" >
                                                        <div class="row mb-4">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Add Notes</label>
                                                            <div class="col-sm-9">
                                                                    <textarea id="formmessage" class="form-control" name="description" rows="3" required disabled></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">

                                                                <div>
                                                                        <button type="submit" class="btn btn-primary w-md" disabled>Update</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="inprogress hide">
                                                    <h4 class="card-title mt-4 mb-4">Lead Details Interested</h4>
                                                    <div class="table-rep-plugin mb-5">
                                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                        <table id="tech-companies-1" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <td>
                                                                        Agent Name
                                                                    </td>
                                                                    <td>
                                                                        Description
                                                                    </td>
                                                                    <td>
                                                                        Reminder Date
                                                                    </td>
                                                                    <td>
                                                                        Date
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                @if (!empty($lead_detail) )
                                                               @foreach ($lead_detail as $lead)
                                                                        <tr>
                                                                            <td>{{@$lead->users->name}}</td>
                                                                            <td>{{@$lead->lead_description}}</td>
                                                                            <td>{{@$lead->reminder_date}}</td>
                                                                            <td>{{date('d-m-Y H:i:s', strtotime($lead->created_at));}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center">No Record Found</td>
                                                                    </tr>

                                                                @endif

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    <form method="POST" action="{{url('leads/lead_store_detail')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="lead_status" value="1" >
                                                        <input type="hidden" name="lead_id" value="{{$leads->id}}" >
                                                        <div class="row mb-4">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Add Notes</label>
                                                            <div class="col-sm-9">
                                                                    <textarea id="formmessage" class="form-control" name="description" rows="3" required disabled></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">

                                                                <div>
                                                                        <button type="submit" class="btn btn-primary w-md" disabled>Update</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="notinterested hide">
                                                    <h4 class="card-title mt-4 mb-4">Lead Details Not Interested</h4>
                                                    <div class="table-rep-plugin mb-5">
                                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                        <table id="tech-companies-1" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <td>
                                                                        Agent Name
                                                                    </td>
                                                                    <td>
                                                                        Description
                                                                    </td>
                                                                    <td>
                                                                        Reminder Date
                                                                    </td>
                                                                    <td>
                                                                        Date
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                @if (!empty($lead_detail) )
                                                                    @foreach ($lead_detail as $lead)
                                                                        <tr>
                                                                            <td>{{@$lead->users->name}}</td>
                                                                            <td>{{@$lead->lead_description}}</td>
                                                                            <td>{{@$lead->reminder_date}}</td>
                                                                            <td>{{date('d-m-Y H:i:s', strtotime($lead->created_at));}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center">No Record Found</td>
                                                                    </tr>

                                                                @endif


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    <form method="POST" action="{{url('leads/lead_store_detail')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="lead_status" value="2" >
                                                        <input type="hidden" name="lead_id" value="{{$leads->id}}" >
                                                        <div class="row mb-4">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Add Notes</label>
                                                            <div class="col-sm-9">
                                                                    <textarea id="formmessage" class="form-control" name="description" rows="3" required disabled></textarea>


                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">

                                                                <div>
                                                                    <button type="submit" class="btn btn-primary w-md" disabled>Update</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="dealclosed hide">
                                                    <a href="{{URL('leads/move_closed/').'/'.$leads->id}}" class="btn btn-success w-md mt-4"><i class="fas fa-check"> </i> Deal Closed</a>
                                                </div>
                                                <div class="transferlead hide">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title mt-4 mb-4">Lead Transfer To Another Agent</h4>

                                                    </div>
                                                    <form method="POST" action="{{url('property_listing_leads/transfer_agent')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-4">
                                                            <label class="col-sm-3 col-form-label">Select Agent</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-select" name="user">
                                                                    <option value="">Choose Agent</option>
                                                                    <option value="24">Ahamad Al Zebn</option>
                                                                    <option value="36">Mohammed Khaled Hassan</option>
                                                                    <option value="37">Omar Hamdino Mohamed</option>
                                                                    <option value="38">Roshdy Osama Mosalam</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="lead_id" value="{{$leads->id}}" >

                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">

                                                                <div>
                                                                    <button type="submit" class="btn btn-success w-md"><i class="fas fa-arrow-right"> </i> Transfer</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="recyclelead hide">
                                                    <div class="col-lg-12 mt-4">
                                                        <a href="{{URL('leads/move_recycle/').'/'.$leads->id}}" class="btn btn-primary w-md">Move to Recycle</a>

                                                        @if (Auth::user()->user_type == '1')
                                                            <a href="{{URL('leads/move_trash/').'/'.$leads->id}}" class="btn btn-danger w-md">  <i class="far fa-trash-alt"> </i> Move to Trash</a>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>
                                            </div>
                                        </div>





                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


                            </div>


                        </div>
                        <!-- end row -->






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
