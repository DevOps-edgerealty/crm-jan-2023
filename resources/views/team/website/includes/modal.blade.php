@foreach ($leads as $lead)
    <div class="modal fade bs-example-modal-lg-center-{{ $lead->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                <th scope="row">Last Update:</th>
                                                <td>{{@$lead->lead_detailss->lead_description}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endforeach
