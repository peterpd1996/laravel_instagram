<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;
class ProfileController extends Controller
{
    //
    public function index($user)
    {
       $user  =  User::findOrFail($user);
       $follow = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
       $saved=auth()->user()->favorite->toArray();
        $data=[
            'user'=>$user,
            'follow'=>$follow,
            'saved'=>$saved,

        ];
       return view('profiles.index',$data);
    }
    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);
        // mình phải tạo 1 thằng policy liên quan tới model mình cần bảo vệ vi
        //vd  php artisan make:policy ProfilePolicy -m Profile // tham số đầu tiên lúc nào cũng là User tham số thứ 2 sẽ là Profile

        return view('profiles.edit',compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update',$user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => '',
            'url' => '',

        ],
        [
            'description.required' => 'Bạn phải nhập tiêu đề',
        ]);

        $image = '';
        if(request('profileImage'))
        {
            $file = request()->file('profileImage');
            $image = $file->getClientOriginalName();
            $file->move('profiles',$image);
            $imageResize = Image::make("profiles/{$image}")->fit(800,800);
            $imageResize->save();
        }
        /* arrray_merge nó sẽ gộp mạng lại thành 1 mảng nếu mảng là kiểu
         associative arrays(mảng kết hợp) thì nó sẽ xem chỉ số nếu trùng nhau thì nó sẽ lấy cái mản
         g đằng sau
        */
        // user không chọn ảnh
        if($image=='')
        {
            auth()->user()->profile->update($data);
        }
        else
        {
            auth()->user()->profile->update(array_merge(
                $data,['profileImage'=>$image]
            ));
        }

        return redirect("/profile/{$user->id}");
    }

}
