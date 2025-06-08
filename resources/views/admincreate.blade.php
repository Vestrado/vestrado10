@extends('admin.layout.admin')

@section('main-content')

    <h1 class="text-2xl font-bold mb-6">Add New Product</h1>

    <!-- DataTable -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Header</h6>
        </div> --}}
        <div class="card-body">
            <div class="table-responsive">

                @if (session('success'))
                    <div class="card mb-4 py-1 border-left-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="card mb-4 py-1 border-left-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
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
                        <input type="text" class="form-control form-control-user" name="prod_name" id="prod_name" value="{{ old('prod_name') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Description</label>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="prod_desc" id="prod_desc" class="form-control form-control-user" required>{{ old('prod_desc') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Points (PTS)</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="pts" id="pts" value="{{ old('pts') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Lots</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="lots" id="lots" value="{{ old('lots') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>Material</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="material" id="material" value="{{ old('material') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label>SKU</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" name="sku" id="sku" value="{{ old('sku') }}" required>
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

                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="S"> S</label>
                        &nbsp;&nbsp;&nbsp;
                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="M"> M</label>
                        &nbsp;&nbsp;&nbsp;
                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="L"> L</label>
                        &nbsp;&nbsp;&nbsp;
                        <label><input class="form-control form-control-user" type="checkbox" name="size[]" value="XL"> XL</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <button type="submit" class="form-control btn btn-success">Add Product</button>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('admin.dashboard') }}" class="form-control btn btn-primary">Cancel</a>
                        </div>
                    </div>

                    <br><br>
                </form>

            </div>
        </div>
    </div>
@endsection

