@extends('layouts.app', ['activePage' => 'reports', 'titlePage' => __('reports')])

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header card-header-tabs card-header-primary">
                            Reports
						</div>
						<div class="card-body">
							<table class="table" id="voters_table">
								<thead>
									<tr>
										<th>Committe</th>
										<th>Location</th>
                                        <th>Total Votes</th>
										<th>Voted </th>
										<th>Not Voted</th>

									</tr>
								</thead>
								<tbody>
									@foreach ($data as $row)
										<tr>
											<td>{{$row->committee}}</td>
                                            <td>{{$row->location}}</td>
                                            <td>{{ $row->total }}</td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    {{ $row->voted }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">
                                                    {{ $row->notvoted }}
                                                </span>
                                            </td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
	<script>
		$(document).ready(function() {
			$('#voters_table').DataTable();
			// $('.search').append($("#voters_table_filter").html());
		});
	</script>
@endpush