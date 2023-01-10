<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Listings</h4>
            <hr>
            </p>

            <div class="row" >
                <div class="col-sm-12">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 831px;">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">
                                    id
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 191px;" aria-label="Purpose: activate to sort column ascending">
                                    PURPOSE
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 87px;" aria-label="Office: activate to sort column ascending">
                                    TYPE
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 35px;" aria-label="Age: activate to sort column ascending">
                                    BEDS
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 79px;" aria-label="Start date: activate to sort column ascending">
                                    LOCATION
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 59px;" aria-label="Salary: activate to sort column ascending">
                                    AREA
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">
                                    PRICE
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">
                                    DESCRIPTION
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 191px;" aria-label="Purpose: activate to sort column ascending">
                                    ASSIGNED
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 87px;" aria-label="Office: activate to sort column ascending">
                                    PHOTOS
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 35px;" aria-label="Age: activate to sort column ascending">
                                    UPDATED
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 79px;" aria-label="Start date: activate to sort column ascending">
                                    STATUS
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 59px;" aria-label="Salary: activate to sort column ascending">
                                    ADVERTISE
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 122px;" aria-sort="ascending" aria-label="Id: activate to sort column descending">
                                    ACTION
                                </th>

                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($listings as $listing)
                                <tr class="odd">
                                    <td class="sorting_1 dtr-control"><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->id}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->purpose}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->type}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}">{{$listing->beds}}</a> </td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->location}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->area}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->price}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{ Str::limit(@$listing->description, 23) }}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{@$listing->users->name}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->photos}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->updated_at}}</a></td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal3-xl-{{ $listing->id }}"> {{$listing->status}}</a></td>
                                    <td>Advertise</td>

                                    <td>
                                        {{-- <a href="{{url('leads/detail').'/'. $lead->id }}" class="btn btn-outline-info btn-sm edit" title="Detail" style="margin-right: 5px">
                                            <i class="fas fa-eye"> </i>
                                        </a>
                                        <a href="{{url('leads/edit').'/'. $lead->id }}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                            <i class="fas fa-pencil-alt"> </i>
                                        </a> --}}
                                    </td>
                                </tr>

                            @endforeach
                            {{-- <tr class="odd">
                                <td class="sorting_1 dtr-control">Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
    </div>
</div> <!-- end col -->
