<div class="container mt-2 d-flex justify-content-end">
    <form action="{{ $actionFormRoute }}" method="GET" class="form-inline my-2 my-lg-0 ">
        <label for="query"></label>
        <input class="form-control mr-sm-2" type="search" id="query" name="query"
            value="{{ request()->get('query') ?? '' }}" placeholder="Tìm kiếm">

        <select class="form-control mr-sm-2" name="sort" id="sort">
            <option {{ request()->get('sort') === 'oldest' ? 'selected' : '' }} value="oldest">Cũ nhất
            </option>
            <option {{ in_array(request()->get('sort'), ['latest', '']) ? 'selected' : '' }} value="latest">
                Mới nhất</option>
        </select>

        <button type="submit"class="btn btn-outline-primary my-2 my-sm-0">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
