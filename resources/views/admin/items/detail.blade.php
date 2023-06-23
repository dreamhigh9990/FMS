<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
        <tr>
            <td>Item Id</td>
            <td>{{$item->id}}</td>
        </tr>
		<tr>
			<td>Item Name</td>
			<td>{{$item->item_name}}</td>
		</tr>
		<tr>
			<td>Description</td>
			<td>{{$item->description}}</td>
		</tr>
        <tr>
			<td>Created At</td>
			<td>{{$item->created_at->diffForHumans()}}</td>
		</tr>

		</tbody>
	</table>
</div>

