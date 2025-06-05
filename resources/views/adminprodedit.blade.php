@extends('admin.layout.admin')

@section('main-content')

    <h1 class="text-2xl font-bold mb-6">Product Summary</h1>

    <!-- DataTable -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Header</h6>
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">

                @if (session('success'))
                    <div class="card mb-4 py-1 border-left-success">
                        <div class="card-body">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- <div class="mb-4">
                        <label for="prod_id" class="block text-sm font-medium text-gray-700">Product ID</label>
                        <input type="text" name="prod_id" id="prod_id" value="{{ old('prod_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Product Name</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="prod_name" id="prod_name" value="{{ $products->prod_name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Description</label>
                        </div>
                        <div class="col-sm-6">
                        <textarea class="form-control form-control-user" name="prod_desc" id="prod_desc" required>{{ $products->prod_desc }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Points (PTS)</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="number" class="form-control form-control-user" name="pts" id="pts" value="{{ $products->pts }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Lots</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="number" class="form-control form-control-user" name="lots" id="lots" value="{{ $products->lots }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Material</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="material" id="material" value="{{ $products->material }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>SKU</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="sku" id="sku" value="{{ $products->sku }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Product Image</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="file" class="form-control form-control-user" name="prod_img" id="prod_img">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Sizes</label>
                        </div>
                        <div class="col-sm-6">

                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="S" {{ in_array('S', explode(',', $products->size)) ? 'checked' : '' }}> S</label>
                        &nbsp;&nbsp;&nbsp;
                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="M" {{ in_array('M', explode(',', $products->size)) ? 'checked' : '' }}> M</label>
                        &nbsp;&nbsp;&nbsp;
                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="L" {{ in_array('L', explode(',', $products->size)) ? 'checked' : '' }}> L</label>
                        &nbsp;&nbsp;&nbsp;
                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="XL" {{ in_array('XL', explode(',', $products->size)) ? 'checked' : '' }}> XL</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <input type="hidden" name="prod_id" value="{{ $products->prod_id }}">
                            <button type="submit" class="form-control btn btn-success">Save</button>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('admin.products.listing') }}" class="form-control btn btn-primary">Back</a>
                        </div>
                    </div>

                    <BR><BR>
                </form>
            </div>
        </div>
    </div>
@endsection
