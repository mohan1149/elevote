@extends('layouts.app', ['activePage' => 'voters', 'titlePage' => __('Voters')])

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header card-header-tabs card-header-primary">
							<div style="text-align: center">
								<h4>Committe ID - {{ auth()->user()->CommitteeID }}</h4>
								<h4>Voted       - {{ $voted }}</h4>
								<h4>Not Voted   - {{ $notvoted }}</h4>
							</div>
						</div>
						<div class="card-body">
							<table class="table" id="voters_table">
								<thead>
									<tr>
										<th>Reg</th>
										<th>Name</th>
										<th>Table </th>
										<th>COM No</th>
										<th>School</th>
										<th>Location</th>
										<th>Status</th>
										<th>Voted On</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($voters as $voter)
										<tr>
											<td>{{ $voter->register_no }}</td>
											<td>{{ $voter->tname }}</td>
											<td>{{ $voter->table_no }}</td>
											<td>{{ $voter->committee }}</td>
											<td>{{ $voter->school }}</td>
											<td>{{ $voter->location }}</td>
											<td>
												@if ($voter->is_voted == 0)
												<span id="badge_{{ $voter->id }}" class="badge badge-warning toggle_badge">NO</span>
												@else
												<span id="badge_{{ $voter->id }}" class="badge badge-success toggle_badge">YES</span>
												@endif
											</td>
											<td>{{ $voter->voted_date }}</td>
											<td>
												<div class="d-flex">
													@if ($voter->is_voted == 0)
													<button onclick="markAsVoted({{$voter->id}})" class="btn btn-primary btn-fab btn-fab-mini btn-round">
														<i class="material-icons">check</i>
													</button>
													@endif
													{{-- <button onclick="markAsNotVoted({{$voter->id}})" class="btn btn-danger btn-fab btn-fab-mini btn-round">
														<i class="material-icons">close</i>
													</button> --}}
												</div>
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
		function markAsVoted(id){
			$.ajax({
				url: "/api/mark/voted",
				method:'POST',
				data:{
					id:id,
				},
				success: function(result){
					$('#badge_'+id).text('YES');
					$('#badge_'+id).removeClass('badge-warning');
					$('#badge_'+id).addClass('badge-success');
  				}
			});
		}
		function markAsNotVoted(id){
			$.ajax({
				url: "/api/mark/notvoted",
				method:'POST',
				data:{
					id:id,
				},
				success: function(result){
					$('#badge_'+id).text('NO');
					$('#badge_'+id).removeClass('badge-success');
					$('#badge_'+id).addClass('badge-warning');
  				}
			});
		}
	</script>
@endpush