       @include('admin.partials.header')
       <div class="col mb-4" align="center">
           <a href="">
               <div class="card-content" style="padding: 20px;border-radius: 10%; heighht:150px; width:150;">
                   <img src="{{ asset('assets/images/ashiap.png') }}" height="100px" width="100px" alt="" />
               </div>
               <h5 style="margin-top: 15px">
                   Mutasi Kegiatan Harian
               </h5>
           </a>
       </div>
       <div style=" overflow-x: auto; overflow-y: auto;">
           <table class="table table-striped">

               <thead>
                   <tr>
                       <th scope="col-3">No</th>
                       <th scope="col-3">Unit</th>
                       <th scope="col-3">Waktu Pemantauan</th>
                       <th scope="col-3">Lokasi Pemantauan</th>
                       <th scope="col-3">Aksi</th>

                   </tr>
               </thead>
               @php
                   $no = 0;
               @endphp
               <tbody>
                   @foreach ($datas as $data)
                       @php
                           $no += 1;
                       @endphp
                       <tr>
                           <th scope="row">{{ $no }}</th>
                           @php
                               $unit = DB::table('operasionals')
                                   ->select()
                                   ->where('id', $data->unit)
                                   ->first();
                           @endphp
                           <td>{{ $unit->nama }}</td>
                           @php
                               $time = DB::table('monitoring_time')
                                   ->select()
                                   ->where('id', $data->waktu_pemantauan)
                                   ->first();
                           @endphp
                           <td>{{ $time->start_time }} - {{ $time->end_time }}</td>
                           @php
                               $lokasi = DB::table('monitoring_locations')
                                   ->select()
                                   ->where('id', $data->lokasi_pemantauan)
                                   ->first();
                           @endphp
                           <td>{{ $lokasi->nama }}</td>
                           <td>
                               <a href="{{ route('mutasi.edit', $data->id) }}" type="button" class="btn btn-primary">
                                   Edit</a>
                               {{-- <form method="post" action="{{ route('mutasi.delete', $data->id) }}">
                               @csrf
                               @method('Delete')
                               
                               <button type="submit" class="btn btn-danger"> Delete</button>
                           </form> --}}
                           </td>
                           {{-- <td><a href="{{ route('admin.mutasi.export',$data->id) }}" type="button" class="btn btn-primary"> Print Preview</a>
                                <a href="{{ route('admin.mutasi.export',$data->no_mutation) }}" type="button" class="btn btn-info">Detail</a></td> --}}
                       </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
       <a href="{{ route('mutasi-kegiatan.index') }}" class="btn btn-primary" style="color: white">Back</a>
            <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Isi footer, misalnya informasi tambahan, tautan, dll. -->
                <p>&copy; 2023 Developed By TKJ PNUP</p>
            </div>
        </div>
    </div>
</footer>
       @include('admin.partials.footer')
