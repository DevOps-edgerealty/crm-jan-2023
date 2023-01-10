
@extends('layout.master')

@section('content')
<style>
#panel {

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
                        <h4 class="mb-sm-0 font-size-18">New Listing</h4>



                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{URL('listings')}}">Listings</a></li>
                                <li class="breadcrumb-item active">Add Listing</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->





            {{-- Add New Listing Wizard --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title mb-4">Basic Wizard</h4> --}}

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link d-flex justify-content-start py-3  text-dark ms-2 disabled" style="width: 300px;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click back to continue">
                                        <span class="font-size-14">Page 01 - Information</span>
                                    </button>

                                    <button class="nav-link active d-flex justify-content-start py-3 text-light bg-dark bg-opacity-100 " style="width: 350px;"id="nav-common-tab" data-bs-toggle="tab" data-bs-target="#nav-common" type="button" role="tab" aria-controls="nav-common" aria-selected="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue" >
                                        <span class="font-size-14">Page 02 - Documents & other media</span>
                                    </button>


                                    <button class="nav-link d-flex justify-content-start py-3 text-dark  " style="width: 200px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 03 - Bayut</span>
                                    </button>


                                    <button class="nav-link d-flex justify-content-start py-3 text-dark  " style="width: 250px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 04 - Property Finder</span>
                                    </button>
                                </div>


                            </nav>


                            {{-- Page 01 - Information --}}
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-common" role="tabpanel" aria-labelledby="nav-common-tab">

                                    <h3 id="basic-example-h-0" tabindex="-1" class="title current pt-4">Documents & Media Information</h3>
                                    <section id="basic-example-p-0" role="tabpanel" aria-labelledby="basic-example-h-0" class="body current" aria-hidden="false">


                                        <form method="POST" action="{{url('/listing2/page-two')}}" enctype="multipart/form-data" class="needs-validation">

                                            @csrf




                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        @include('listing2.addListing.includes.photos')
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>



                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        @include('listing2.addListing.includes.videos')
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card">
                                                        @include('listing2.addListing.includes.documents')
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="card">
                                                        @include('listing2.addListing.includes.floorplans')
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-dark btn-lg waves-effect waves-light">
                                                        Upload and Continue
                                                </button>
                                            </div>


                                        </form>
                                    </section>

                                </div>
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            {{-- Add New Listing Wizard --}}





        </div>
    </div>
</div>




@endsection
