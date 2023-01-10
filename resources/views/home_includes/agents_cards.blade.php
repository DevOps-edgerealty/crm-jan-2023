<div class="card shadow-sm"  style="min-height: 475px;">
                    <div class="card-body ">
                        <h4 class="card-title mb-4">Classified Leads</h4>

                        <div class="text-center">
                            <div class="mb-2">
                                <i class="bx bx-map-pin text-black display-6"></i>
                            </div>
                            <h3>{{ $total_all_leads_accumulated}}</h3>
                            <p>Total Leads</p>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table align-middle table-nowrap">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%">
                                            <p class="mb-0">Interested Leads</p>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0">{{ number_format($total_cat_interested)}}</h5></td>
                                        <td>
                                            <div class="progress bg-transparent progress-sm">
                                                <div class="progress-bar bg-black rounded" role="progressbar" style="width: {{$total_cat_interested}}%" aria-valuenow="{{$total_cat_interested}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="mb-0">Not Interested</p>
                                        </td>
                                        <td>
                                            <h5 class="mb-0">{{ number_format($total_cat_not_interested)}}</h5>
                                        </td>
                                        <td>
                                            <div class="progress bg-transparent progress-sm">
                                                <div class="progress-bar bg-black rounded" role="progressbar" style="width: {{$total_cat_not_interested}}%" aria-valuenow="{{$total_cat_not_interested}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="mb-0">No Answer</p>
                                        </td>
                                        <td>
                                            <h5 class="mb-0">{{ number_format($total_cat_no_answer)}}</h5>
                                        </td>
                                        <td>
                                            <div class="progress bg-transparent progress-sm">
                                                <div class="progress-bar bg-black rounded" role="progressbar" style="width: {{$total_cat_no_answer}}%" aria-valuenow="{{$total_cat_no_answer}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
