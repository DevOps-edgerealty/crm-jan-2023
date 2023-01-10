
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
                        <h2 class="mb-sm-0 font-size-25 text-center">Create a New Listing</h2>



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
                                    <button class="nav-link active d-flex justify-content-start py-3 bg-dark bg-opacity-100 text-light ms-2 " style="width: 300px;" id="nav-common-tab" data-bs-toggle="tab" data-bs-target="#nav-common" type="button" role="tab" aria-controls="nav-common" aria-selected="true">
                                        <span class="font-size-14">Page 01 - Information</span>
                                    </button>

                                    <button class="nav-link d-flex justify-content-start py-3  text-dark " style="width: 350px;"s data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue" >
                                        <span class="font-size-14">Page 02 - Documents & other media</span>
                                    </button>


                                    <button class="nav-link d-flex justify-content-start py-3  text-dark  " style="width: 200px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 03 - Bayut</span>
                                    </button>


                                    <button class="nav-link d-flex justify-content-start py-3  text-dark  " style="width: 250px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Click next to continue">
                                        <span class="font-size-14">Page 04 - Property Finder</span>
                                    </button>
                                </div>


                            </nav>


                            {{-- Page 01 - Information --}}
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-common" role="tabpanel" aria-labelledby="nav-common-tab">

                                    <h3 id="basic-example-h-0" tabindex="-1" class="title current pt-4">Basic Property Information</h3>
                                    <section id="basic-example-p-0" role="tabpanel" aria-labelledby="basic-example-h-0" class="body current" aria-hidden="false">


                                        <form method="POST" action="{{url('/listing2/page-one')}}" enctype="multipart/form-data" class="needs-validation">

                                            @csrf

                                            <div class="row col-lg-6 mx-auto my-4">
                                                <div class="col-lg-3">
                                                    <div class="mb-3 mx-auto d-flex justify-content-center font-size-20">
                                                        <input class="form-check-input" type="checkbox" name="bayut" value="bayut" id="bayut">
                                                        <label class="form-check-label" for="bayut">
                                                            &nbsp; Bayut
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="mb-3 mx-auto d-flex justify-content-center font-size-20">
                                                        <input class="form-check-input" type="checkbox" name="pf" value="pf" id="pf">
                                                        <label class="form-check-label" for="pf">
                                                            &nbsp; Property Finder
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="mb-3 mx-auto d-flex justify-content-center font-size-20">
                                                        <input class="form-check-input" type="checkbox" name="dubizzle" value="duizzle" id="dubizzle">
                                                        <label class="form-check-label" for="dubizzle">
                                                            &nbsp; Dubizzle
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="mb-3 mx-auto d-flex justify-content-center font-size-20">
                                                        <input class="form-check-input" type="checkbox" name="generic" value="generic" id="generic">
                                                        <label class="form-check-label" for="generic">
                                                            &nbsp; Generic
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-firstname-input">Property Title</label>
                                                            <input type="text" class="form-control" name="title_en" id="basicpill-propertytitle-input" placeholder="Enter the Property Title" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-lastname-input">Property Title &#40;Arabic&#41;</label>
                                                            <input type="text" class="form-control" name="title_ar" dir="rtl" id="basicpill-lastname-input" placeholder="أدخل عنوان الخاصية">
                                                        </div>
                                                    </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-phoneno-input" required>Bedrooms</label>
                                                        <select class="form-select " name="beds">
                                                            <option value="">Select</option>
                                                            <option value="0">N/A</option>
                                                            <option value="Studio">Studio</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="1">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20+</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-email-input" required>Bathrooms</label>
                                                        <select class="form-select " name="baths">
                                                            <option value="">Select</option>
                                                            <option value="0">N/A</option>
                                                            <option value="Studio">Studio</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="1">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20+</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-email-input" required>Parking</label>
                                                        <select class="form-select " name="parking">
                                                            <option value="">Select</option>
                                                            <option value="0">No</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="1">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="Price">Price</label>
                                                        <div class="input-group  mb-3">
                                                            <input type="number" class="form-control" name="price" id="Price" value="" aria-describedby="option-zIndex" placeholder="100" required>
                                                            <span class="input-group-text" id="option-zIndex">AED</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="cheques">Cheques</label>
                                                        <select class="form-control " name="cheques" id="cheques" required>
                                                            <option value="">Select Cheque Type</option>
                                                            <option value="1 Cheque (Yearly)">1 Cheque (Yearly)</option>
                                                            <option value="2 Cheque (Yearly)">2 Cheque (Yearly)</option>
                                                            <option value="3 Cheque (Yearly)">3 Cheque (Yearly)</option>
                                                            <option value="4 Cheque (Yearly)">4 Cheque (Yearly)</option>
                                                            <option value="6 Cheque (Yearly)">6 Cheque (Yearly)</option>
                                                            <option value="12 Cheque (Yearly)">12 Cheque (Yearly)</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="frequency">Frequency</label>
                                                        <select class="form-select " name="frequency" id="frequency" required>
                                                            <option value="Yearly">Yearly</option>
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Daily">Daily</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Description</label>
                                                        <textarea id="basicpill-address-input" class="form-control" name="description_en" rows="5" placeholder="Enter a Description" required></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Description &#40;Arabic&#41;</label>
                                                        <textarea id="basicpill-address-input" class="form-control" name="description_ar" dir="rtl" rows="5" placeholder="أدخل وصفًا"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12 my-2">
                                                    <div class="mb-3 d-flex justify-content-end">
                                                       <button class="btn btn-dark btn-md btn-block w-25 me-2">Cancel and Go Back</button>
                                                       <button class="btn btn-success btn-md btn-block w-25 ">Continue Page 02</button>
                                                    </div>
                                                </div>
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
