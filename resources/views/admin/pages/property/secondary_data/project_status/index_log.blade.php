<div class="card bg-light border border-secondary">
    <div class="card-body">
        <div class="">
            <table class="table-bordered table table-stripped mt-3 mb-3">
                <thead style="background: #c0cfff;">
                    <tr>
                        <th>Sl.no</th>
                        <th>Project Status</th>
                        <th>Project Expected Date Of Start </th>
                        <th>Project Expected Date Of Completion </th>
                        <th>Project Date Of Completion</th>
                        <th>Updated date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($project_status_log as $status)
                        <tr>
                            <td>{{ $loop->iteration ?? 'N/A' }}</td>
                            <td>{{ $status->projectStatus->name ?? 'N/A' }}</td>
                            <td>
                                @if (!empty($status->project_expected_date_of_start))
                                    {{ date('d-m-Y', strtotime($status->project_expected_date_of_start)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($status->project_expected_date_of_completion))
                                    {{ date('d-m-Y', strtotime($status->project_expected_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($status->project_date_of_completion))
                                    {{ date('d-m-Y', strtotime($status->project_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <th>{{ date('d-m-Y', strtotime($status->created_at)) }}</th>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <div id="pagination">
                {{-- {{ $project_status_log->links('pagination::bootstrap-4', ['secure' => true]) }} --}}
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-md-12 col-xxl-12"> --}}
<div class="card bg-light border border-secondary">
    <div class="card-body">
        <div class="">
            <table class="table-bordered table table-stripped mt-3 mb-3">
                <thead style="background: #c0cfff;">
                    @if ($property->residential_type == 7)
                        <tr>
                            <th>Sl.no</th>
                            <th>Tower</th>
                            <th>Tower Status</th>
                            <th>Tower Expected Date Of Start</th>
                            <th>Tower Expected Date Of Completion </th>
                            <th>Tower Date Of Completion</th>
                            <th>Construction Stage</th>
                            <th>Floor Range</th>
                            <th>Updated date</th>
                        </tr>
                    @else
                        <tr>
                            <th>Sl.no</th>
                            <th>Unit</th>
                            <th>Unit Status</th>
                            <th>Unit Expected Date Of Start</th>
                            <th>Unit Expected Date Of Completion </th>
                            <th>Unit Date Of Completion</th>
                            <th>Construction Stage</th>
                            {{-- <th>Floor Range</th> --}}
                            <th>Updated date</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @forelse($towers as $tower)
                        <tr>
                            <td>{{ $loop->iteration ?? 'N/A' }}</td>
                            <td>{{ $tower->towerName->tower_name ?? '' }}</td>
                            <td>{{ $tower->towerStatus->name ?? 'N/A' }}</td>
                            <td>
                                @if (!empty($tower->tower_expected_date_of_start))
                                    {{ date('d-m-Y', strtotime($tower->tower_expected_date_of_start)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($tower->tower_expected_date_of_completion))
                                    {{ date('d-m-Y', strtotime($tower->tower_expected_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($tower->tower_date_of_completion))
                                    {{ date('d-m-Y', strtotime($tower->tower_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $tower->constructionStage->stage_name ?? '' }}</td>
                            @if ($property->residential_type == 7)
                                <td>{{ $tower->FloorRangesPerTower->floor_range ?? '' }}</td>
                            @endif
                            <th>{{ date('d-m-Y', strtotime($tower->created_at)) }}</th>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <div id="pagination">
                {{-- {{ $project_status_log->links('pagination::bootstrap-4', ['secure' => true]) }} --}}
            </div>
        </div>
    </div>
</div>
{{-- </div>
</div> --}}
