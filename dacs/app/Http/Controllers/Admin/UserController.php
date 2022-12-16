<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Sevice\User\UserSeviceInterface;
use App\Utilities\Common;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userSevice;

    public function __construct(UserSeviceInterface $userSevice)
    {
        $this->userSevice = $userSevice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userSevice->searchAndPaginate('name', $request->get('search'));
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('password') != $request->get('password_confirmation')){
        return back()->with('notification', 'ERROR: Comfirm password does not match');
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->get('password'));

        if($request->hasFile('image')){
            $data['avatar'] = Common::uploadFile($request->file('image'), 'front/img/user');
        }

        $user = $this->userSevice->create($data);

        return redirect('admin/user/'.$user->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        //Xu li mat khau
        if($request->get('password') != null){
            if($request->get('password') != $request->get('password_confirmation')){
                return back()->with('notification', 'ERROR: Comfirm password does not match');
            }
            $data['password'] = bcrypt($request->get('password'));
        }else{
            unset($data['password']);
        }

        //Xu li file picture
        if($request->hasFile('image')){
            //add new file
            $data['avatar'] = Common::uploadFile($request->file('image'), 'front/img/user');

            //delete old file
            $file_name_old = $request->get('image_old');
            if(file_exists($file_name_old)){
                unlink('front/image/user/' . $file_name_old);
            }
        }

        //Update data
        $this->userSevice->update($data, $user->id);

        return  redirect('admin/user/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userSevice->delete($user->id);

        //Delete file
        $file_name = $user->avatar;
        if(file_exists($file_name)){
            unlink('front/img/user/' . $file_name);
        }
        return redirect('admin/user');
    }
}
