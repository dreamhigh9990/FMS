<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
        <tr>
            <td>Driver</td>
            <td>{{$manifest->driver_name->name}}</td>
        </tr>
		<tr>
			<td>Dispatch Branch</td>
			<td>{{$manifest->from_manifest['branches']}}</td>
		</tr>
		<tr>
			<td>Receiving Branch</td>
			<td>
				{{$manifest->to_manifest['branches']}}
			</td>
		</tr>
        <tr>
			<td>Type</td>
			<td>
				{{$manifest->type}}
			</td>
		</tr>
        <tr>
            <td>Arrival Date</td>
            <td>
                {{$manifest->arrival_date}}
            </td>
        </tr>
		<tr>
			<td>Created at</td>
			<td>{{$manifest->created_at}}</td>
		</tr>

		</tbody>
	</table>
</div>

