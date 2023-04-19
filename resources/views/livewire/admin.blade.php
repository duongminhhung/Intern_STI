
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
     
   
        @foreach ($role_name as $item)
            @if ($item->id_role == 1)
              <a href="{{route('admin.add')}}" class="btn btn-primary" wire:mode="add_user">Thêm</a>
            @elseif($item->id_role ==2)
              <button class="btn btn-primary">Xem</button>
            @endif
        @endforeach
      <form action="{{route('admin.import')}}" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <label>Select File to Upload  <small class="warning text-muted">{{__('Please upload only Excel (.xlsx or .xls) files')}}</small></label>
            <div class="input-group">
                <input type="file" required class="form-control" name="uploaded_file" id="uploaded_file">
                @if ($errors->has('uploaded_file'))
                    <p class="text-right mb-0">
                        <small class="danger text-muted" id="file-error">{{ $errors->first('uploaded_file') }}</small>
                    </p>
                @endif
                <div class="input-group-append" id="button-addon2">
                    <button class="btn btn-primary square" type="submit"><i class="ft-upload mr-1"></i> Upload</button>
                </div>
            </div>
        </fieldset>
      </form>
      <br>
      <a href="{{route('admin.export')}}" class="btn btn-primary" style="margin-left:85%">Export Excel Data</a>

      <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Email</th>
                <th scope="col">Chức vụ</th>
                @foreach ($role_name as $item)
                @if ($item->id_role == 3)
                <th scope="col">Tác vụ</th>
                @endif
            @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($user as $item)
              <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                @if($item->role==0)
                <td>Nhân viên</td>
                @else
                <td>Amin</td>
                @endif
                @foreach ($role_name as $items)
                @if ($items->id_role == 3)
                <td><a href="{{route('admin.update',$item->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                  </svg></a>
                </td>
                @endif
            @endforeach
              </tr>
              @endforeach
            </tbody>
            {{-- {{ $user->links() }} --}}

          </table>
    </div>
  </main>
