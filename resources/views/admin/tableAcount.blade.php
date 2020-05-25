    <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Họ và tên</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Khóa</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($users))
                    @foreach($users as $index =>$user)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            @if($user->is_block == 0)
                            <td><div class="btn btn-block btn-success btn-sm">Hoạt động</div></td>
                            @else
                              <td><div class="btn btn-block btn-danger btn-sm" >Khóa {{$user->time_block}}</div></td>
                            @endif
                             {{-- btn-block btn-danger btn-sm  --}} 
                            <td>
                                <div class="row">

                                    <div class="btn btn-danger block col-md-4" data-block="{{$user->is_block}}" data-id={{$user->id}}>Khóa</div>
                                    <select class="form-control col-md-5">
                                        <option value="0">Thời gian</option>
                                        <option value="3">3 ngay</option>
                                        <option value="7">1 tuần</option>
                                        <option value="30">1 thang</option>
                                    </select>
                                    @if($user->is_block == 1)
                                    <div class="btn btn-block btn-success btn-sm col-md-3 unblock" data-id={{$user->id}}>Mở</div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                 @endif
                </tbody>
            </table>