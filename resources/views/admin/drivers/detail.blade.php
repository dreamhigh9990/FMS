<div class="card-datatable table-responsive">
    <table id="clients" class="datatables-demo table table-striped table-bordered">
        <tbody>
        <tr>
            <td>Name</td>
            <td>{{$driver->name}}</td>
        </tr>
        <tr>
            <td>Phone no</td>
            <td>{{$driver->phone_no}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                @if($driver->active)
                    <label class="label label-success label-inline mr-2">Active</label>
                @else
                    <label class="label label-danger label-inline mr-2">Inactive</label>
                @endif
            </td>
        </tr>
        <tr>
            <td>Created at</td>
            <td>{{$driver->created_at}}</td>
        </tr>

        </tbody>
    </table>
</div>

