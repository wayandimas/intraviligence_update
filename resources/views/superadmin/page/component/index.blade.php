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
                                <h4 class="mt-0 header-title">Komponen</h4>

                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Buat
                                </button>
                                
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Buat Komponen</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('superadmin.komponen.create') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="code">Nama</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            placeholder="Nama">
                                                    </div>
                                                
                                                        <div class="form-group">
                                                            <label for="code">Alias</label>
                                                            <input type="text" name="alias" class="form-control"
                                                                placeholder="Alias">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Kategori</label>
                                                            <select class="form-control" name="kategori"
                                                                id="exampleFormControlSelect1">
                                                                <option>Pilih</option>
                                                                @foreach ($kategori as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama.'-'.$item->operasional->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alias</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($komponen as $data)
                                        <p>{{ $data->nama }}</p>
                                        @endforeach --}}
                                        @php
                                        // dd($komponen);
                                            $no = 1;
                                        @endphp
                                        @if ($komponen)
                                        @foreach ($komponen as $data)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->alias }}</td>
                                                @php
                                                    $kat = DB::table('categories')->where('id',$data->kategori['id'])->first();
                                                    $ope =DB::table('operasionals')->where('id',$kat->operasional_id)->first();
                                                @endphp
                                                <td>{{ $kat->nama.'-'.$ope->nama  }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#Edit-{{ $data->id }}">Edit</button>
                                                    <button class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#N{{ $data->id }}">Delete</button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="N{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this {{ $data->nama }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form id="deleteForm" method="POST" action="{{ route('superadmin.komponen.delete',$data->id) }}">
                                                                @csrf
                                                                @method('Delete')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $no++;
                                            @endphp
                                            <div class="modal fade" id="Edit-{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Komponen
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('superadmin.komponen.update', $data->id) }}"
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
                                                                    <label for="alias">Alias</label>
                                                                    <input type="text" name="alias"
                                                                        class="form-control"
                                                                        value="{{ $data->alias }}"
                                                                        placeholder="Alias">
                                                                </div>
                                                                <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Kategori</label>
                                                            <select class="form-control" name="kategori"
                                                                id="exampleFormControlSelect1">
                                                                <option>Pilih</option>
                                                                @foreach ($kategori as $item)
                                                                <option value="{{ $item->id }}" {{ $data->categori_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama . '-' . $item->operasional->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Keluar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                           
                                        @endforeach
                                        @endif
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
