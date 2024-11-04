@extends('layouts.app')

@section('title', 'Products')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>
                <div class="section-header-button">
                    <a href="{{ route('product.create') }}"
                        class="btn btn-primary">Add New</a>
                </div>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Products</a></div>
                    <div class="breadcrumb-item">All Products</div>
                </div>
            </div>
            @include('layouts.alert')
            <div class="section-body">
                <h2 class="section-title">Products</h2>
                <p class="section-lead">
                    You can manage all Products, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Products</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                name="name"
                                                placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Name</th>
                                            <th>price</th>
                                            <th>stock</th>
                                            <th>category</th>
                                            <th>image</th>
                                        </tr>

                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('product.edit', $product->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();"
                                                        class="text-danger">Trash'
                                                    </a>
                                                    <form
                                                    action="{{ route('product.destroy', $product->id) }}"
                                                     method="POST"
                                                     id="delete-form-{{ $product->id }}">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $product->price }}
                                            </td>
                                            <td>
                                                {{ $product->stock }}
                                            </td>
                                            <td>
                                                {{ $product->category }}
                                            </td>
                                            <td>
                                                @if($product->image)
                                                    <img src="{{ asset('storage/products/'.$product->image) }}"
                                                     class="w-100 h-100">
                                                     @else
                                                       <span class="badge badge-warning">No Image</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                    </table>
                                </div>
                                <div class="float-right">
                                    <nav>
                                        {{ $products->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
