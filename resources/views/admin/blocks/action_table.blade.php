<a href="{{ $actionDetailRoute, ['product' => $data->id]) }}" class="btn btn-outline-info"><i
        class="fa fa-eye"></i></a>
<form action="{{ route('admin.product.destroy', ['product' => $data->id]) }}" method="post" class="d-inline">
    @csrf
    <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you sure?')"><i
            class="fa fa-trash"></i></button>
</form>
