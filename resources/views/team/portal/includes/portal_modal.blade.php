@foreach ($leads as $lead)
<div class="modal fade bs-example-modal-xl-{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lead Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Refrence Number :</th>
                                                <td>{{$lead->ref_no}}</td>
                                            </tr>
                                            <tr>
                                                <th>Inquiry</th>
                                                <td>{{$lead->inquiry}}</td>
                                            </tr>
                                            <tr>
                                                <th>Portal</th>
                                                <td>
                                                    @if ($lead->from == 'no-reply23@email.dubizzle.com')
                                                        Dubbizle
                                                    @elseif ($lead->from == 'no-reply@propertyfinder.ae')
                                                        Property finder
                                                    @elseif ($lead->from == 'noreply@bayut.com')
                                                        Bayut
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td>{{$lead->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile :</th>
                                                <td>{{$lead->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-mail :</th>
                                                <td>{{$lead->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agent Name :</th>
                                                <td>{{@$lead->users->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Location :</th>
                                                <td>{{$lead->location}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Property Detail :</th>
                                                <td>{{$lead->property_detail}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Property Location :</th>
                                                <td>{{$lead->property_location}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Last Update</th>
                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>







                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endforeach
