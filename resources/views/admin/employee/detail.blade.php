<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
        <tr>
            <td>First Name </td>
            <td>{{$employee->first_name}}</td>
        </tr>
		<tr>
			<td>Last Name</td>
			<td>{{$employee->last_name}}</td>
		</tr>
        <tr>
            <td>Branch</td>
            <td>{{$employee->branch->branches}}</td>
        </tr>
		<tr>
			<td>Employee ID</td>
			<td>{{$employee->employee_id}}</td>
		</tr>
        <tr>
			<td>Can Login</td>
            <td>
                @if($employee->can_login)
                    <label class="label label-success label-inline mr-2">Active</label>
                @else
                    <label class="label label-danger label-inline mr-2">Inactive</label>
                @endif
            </td>
        </tr>
        <tr>
			<td>Can Use App</td>
            <td>
                @if($employee->can_use_app)
                    <label class="label label-success label-inline mr-2">Active</label>
                @else
                    <label class="label label-danger label-inline mr-2">Inactive</label>
                @endif
            </td>
        </tr>

        <tr>
			<td>Created At</td>
			<td>{{$employee->created_at->diffForHumans()}}</td>
		</tr>

		</tbody>
	</table>
</div>

