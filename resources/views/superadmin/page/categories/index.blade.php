@include('superadmin.partials.header')
@include('superadmin.partials.navbar')

<div class="content-page">
    <div class="content">
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                @if ($errors->first('message'))
                                    <div class="form-group">
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errors->first('message') }}
                                        </div>
                                    </div>
                                @endif
                                @if (Session::has('message'))
                                    <div class="form-group">
                                        <div class="alert alert-info" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                    </div>
                                @endif
                                <h4 class="mt-0 header-title">Category</h4>

                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Create
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="code">Nama</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            placeholder="Nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Operasional</label>
                                                        <select class="form-control" name="operasional"
                                                            id="exampleFormControlSelect1">
                                                            <option>Choose</option>
                                                            @foreach ($op as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Operasional</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($kategori as $data)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->operasional->nama }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm btn-edit" data-toggle="modal"
                                                        data-target="#Edit-{{ $data->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal"
                                                        data-target="#N{{ $data->id }}">Delete</button>
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                            <div class="modal fade" id="Edit-{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Users
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('superadmin.category.update', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="nama">Nama</label>
                                                                    <input type="text" name="nama"
                                                                        class="form-control"
                                                                        value="{{ $data->nama }}" placeholder="Nama">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="operasional">Operasional</label>
                                                                    <select class="form-control" name="operasional"
                                                                        id="operasional">
                                                                        @foreach ($op as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                @if ($data->operasional->id == $item->id) selected @endif>
                                                                                {{ $item->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="N{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="confirmDeleteModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                Confirmation</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this
                                                                {{ $data->nama }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form id="deleteForm" method="POST"
                                                                action="{{ route('superadmin.category.delete', $data->id) }}">
                                                                @csrf
                                                                @method('Delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('superadmin.partials.footer')
