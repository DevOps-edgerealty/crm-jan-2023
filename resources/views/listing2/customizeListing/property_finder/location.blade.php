

    <div class="row">

        <!-- Customize Listing -->
        <div id="customizeNewListing" style="display:block;">
            <h3 class="card-title mt-4">City</h3>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <form method="POST" action="{{url('/listing_pf_customize/category/store')}}" enctype="multipart/form-data" class="row needs-validation">
                            @csrf
                            <div class="col-lg-8">
                                <input type="text" name="category" class="form-control" placeholder="Enter a city name">
                            </div>

                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-dark btn-block form-control">Create City</button>
                            </div>
                        </form>
                    </div>





                    <div class="col-md-6">
                        <form method="POST" action="{{url('/listing_pf_customize/property_type/store')}}" enctype="multipart/form-data" class="row needs-validation">
                            @csrf
                            <div class="col-lg-4">
                                <input type="text" name="property_type" class="form-control" placeholder="Enter the community name">
                            </div>

                            <div class="col-lg-4">
                                {{-- <input type="text" name="property_type" class="form-control" placeholder="Enter the property type name"> --}}

                                <select class="form-select w-100" name="property_type_category" required>
                                    <option value="">Select a City</option>
                                    @if(!empty($pf_cities))
                                        @if ($pf_cities!=null)
                                            @foreach ($pf_cities as $city)
                                                <option value="{{ $city->id}}">{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    @endif

                                </select>
                            </div>

                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-dark btn-block form-control w-100">Create Community</button>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="row mt-3">

                <!-- Community Table -->
                <div class="col-lg-6">
                    <div class="card text-dark shadow-sm" style="height: 200px">
                        <h6 class=" px-3 pt-2 text-dark">Categories</h6>
                        <div class="table-responsive border border-top-3 bg-white">
                            <table class="table table-sm m-0 " height="20px">
                                {{-- <thead class="bg-dark text-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Community Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    @if(!$pf_categories->isEmpty())
                                        @foreach ($pf_categories as $community)

                                            <tr>
                                                <th scope="row">{{ $community->id }}</th>
                                                <td>{{ $community->name }}</td>
                                                <td class="text-center">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-{{ $community->id }}">
                                                        <button class="btn btn-outline-dark btn-sm">Edit</button>
                                                    </a>
                                                    &nbsp;&nbsp;/&nbsp;&nbsp;
                                                    <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-delete-xl-{{ $community->id }}">
                                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p class="mx-3 my-2 text-secondary">no records</p>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- Community Table -->



                <!-- Developers Table -->
                <div class="col-lg-6">
                    <div class="card shadow-sm" style="height: 200px">
                        <h6 class=" px-3 pt-2 text-dark">Property Types</h6>
                        <div class="table-responsive border border-top-3 bg-white">
                            <table class="table table-sm m-0" height="20px">
                                <tbody>
                                    @if(!$pf_property_types->isEmpty())
                                        @foreach ($pf_property_types as $developer)
                                            <tr>
                                                <th scope="row">{{ $developer->id }}</th>
                                                <td>{{ $developer->name }}</td>
                                                <td>{{ $developer->name }}</td>
                                                <td class="text-center">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal2-xl-{{ $developer->id }}">
                                                        <button class="btn btn-outline-dark btn-sm">Edit</button>
                                                    </a>
                                                    &nbsp;&nbsp;/&nbsp;&nbsp;
                                                    <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal2-delete-xl-{{ $developer->id }}">
                                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td><p class=" my-2 mx-3 text-secondary">no records</p></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /Developers Table -->

            </div>
        </div>
        <!-- /Customize Listing -->
    </div>

    <!-- Community Update Modal -->
    @foreach ($pf_categories as $community)

        <div class="modal fade bs-example-modal-xl-{{ $community->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Community Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-rep-plugin mb-3">

                                    <form action="{{url('/listing_pf_customize/category/update/'.$community->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Refrence ID :</th>
                                                        <td><input type="text" name="category_id" value="{{$community->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Category Name :</th>
                                                        <td><input type="text" name="pf_category" value="{{$community->name}}" class="form-control" id="horizontal-firstname-input">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                                                Cancel
                                                            </button>&nbsp;
                                                            <button type="submit" class="btn btn-warning ">
                                                                Update
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach
    <!-- /Community Update Modal -->

    <!-- Community Delete Modal -->
    @foreach ($pf_categories as $community)

        <div class="modal fade bs-example-modal-delete-xl-{{ $community->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure to delete this record?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-rep-plugin mb-3">

                                    <form action="{{url('/listing_pf_customize/category/delete/'.$community->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Refrence ID :</th>
                                                        <td><input type="text" name="community_id" value="{{$community->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Category Name :</th>
                                                        <td><input type="text" name="community" value="{{$community->name}}" class="form-control" id="horizontal-firstname-input" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                Cancel
                                                            </button>&nbsp;
                                                            <button type="submit" class="btn btn-danger ">
                                                                Yes, delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endforeach
    <!-- /Community Delete Modal -->

    <!-- Developer Modal -->
    @foreach ($pf_property_types as $developer)
        <div class="modal fade bs-example-modal2-xl-{{ $developer->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Developer Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-rep-plugin mb-3">

                                    <form action="{{url('/listing_pf_customize/property_type/update/'.$developer->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Refrence ID :</th>
                                                        <td><input type="text" name="developer_id" value="{{$developer->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Developer Name :</th>
                                                    <td>
                                                        <input type="text" name="pf_property_type" value="{{$developer->name}}" class="form-control" id="horizontal-firstname-input">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                                                Cancel
                                                            </button>&nbsp;
                                                            <button type="submit" class="btn btn-warning ">
                                                                Update
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endforeach
    <!-- /Developer Modal -->

    <!-- Developer Delete Modal -->
    @foreach ($pf_property_types as $developer)

        <div class="modal fade bs-example-modal2-delete-xl-{{ $developer->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure to delete this record?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-rep-plugin mb-3">

                                    <form action="{{url('/listing_pf_customize/property_type/delete/'.$developer->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Refrence ID :</th>
                                                        <td><input type="text" name="developer_id" value="{{$developer->id}}" class="form-control" id="horizontal-firstname-input" disabled></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Developer Name :</th>
                                                        <td><input type="text" name="pf_property_type" value="{{$developer->name}}" class="form-control" id="horizontal-firstname-input" disabled>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                Cancel
                                                            </button>&nbsp;
                                                            <button type="submit" class="btn btn-danger ">
                                                                Yes, delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endforeach
    <!-- /Developer Delete Modal -->
