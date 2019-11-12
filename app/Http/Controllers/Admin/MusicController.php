<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class MusicController extends Controller
{
    protected $model;


    public function __construct(Music $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data = $this->model->index($request);
        return view('admin.music.index', compact('data'));
    }

    public function create()
    {
        return $this->render_update(null);
    }

    public function render_update($item = null)
    {
        return view('admin.music.create', compact('item'));

    }


    public function store(Request $request)
    {
//        dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'desc' => 'nullable|max:500',
            'single' => 'required',
            'music' => 'required',
            'image' => 'required|max:2048',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được lớn hơn 250 kí tự',
            'desc.max' => 'Mô tả không được lớn hơn 500 kí tự',
            'code.required' => 'Code không được để trống',
            'music.required' => 'Nhạc không được để trống',
            'image.required' => 'Ảnh không được để trống',
            'image.max' => 'Ảnh không được lớn hơn 2mb',
        ]);

        if ($request->input('name')) {
            $check_code = $this->model->checkName($request->input('name'), null);
            if ($check_code) {
                $this->setErrorValidation($validator, 'name', __('Tên đã tồn tại'));
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $achievement = new Music();
            $file = $request->file('image');
            $music = $request->file('music');
            $image_path = '';
            $audio_path = '';
            $unique_id = uniqid();
            if ($file) {
                $original_name = $request->file('image')->getClientOriginalName();
                $file_image = Carbon::now()->format('Ymd') . '_' . $unique_id . '.' . $original_name;
                $image_path = 'storage/upload/files/image/' . $file_image;
                $file->storeAs('public/upload/files/image/', $file_image);
            }
            if ($music) {
                $original_name = $request->file('music')->getClientOriginalName();
                $filename = Carbon::now()->format('Ymd') . '_' . $unique_id . '.' . $original_name;
                $audio_path = 'storage/upload/files/audio/' . $filename;
                $file->storeAs('public/upload/files/audio/', $filename);

            }
            $response = $achievement->insert([
                'image' => $image_path,
                'link' => $audio_path,
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'single' => $request->input('single'),
            ]);
            if ($response) {
                return redirect()->route('music.index');
            } else {
                return redirect()->back();
            }
        }
    }


    public function edit($id)
    {
        $item = Music::find($id);
        return $this->render_update($item);
    }

    public function update($id, Request $request)
    {
        $data = Music::find($id);

        if (!$data) {
            return redirect()->back();
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:250',
                'desc' => 'nullable|max:500',
                'single' => 'required',
                'music' => 'required',
                'image' => 'required|max:2048',
            ], [
                'name.required' => 'Tên không được để trống',
                'name.max' => 'Tên không được lớn hơn 250 kí tự',
                'desc.max' => 'Mô tả không được lớn hơn 500 kí tự',
                'code.required' => 'Code không được để trống',
                'music.required' => 'Nhạc không được để trống',
                'image.required' => 'Ảnh không được để trống',
                'image.max' => 'Ảnh không được lớn hơn 2mb',
            ]);

            if ($request->input('name')) {
                $check_code = $this->model->checkName($request->input('name'), null);
                if ($check_code) {
                    $this->setErrorValidation($validator, 'name', __('Tên đã tồn tại'));
                }
            }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $achievement = new Music();
                $file = $request->file('image');
                $music = $request->file('music');
                $image_path = '';
                $audio_path = '';
                $unique_id = uniqid();
                if ($file) {
                    $original_name = $request->file('image')->getClientOriginalName();
                    $file_image = Carbon::now()->format('Ymd') . '_' . $unique_id . '.' . $original_name;
                    $image_path = 'storage/upload/files/image/' . $file_image;
                    $file->storeAs('public/upload/files/image/', $file_image);
                }
                if ($music) {
                    $original_name = $request->file('music')->getClientOriginalName();
                    $filename = Carbon::now()->format('Ymd') . '_' . $unique_id . '.' . $original_name;
                    $audio_path = 'storage/upload/files/audio/' . $filename;
                    $file->storeAs('public/upload/files/audio/', $filename);

                }
                $response = $achievement->insert([
                    'image' => $image_path,
                    'link' => $audio_path,
                    'name' => $request->input('name'),
                    'desc' => $request->input('desc'),
                    'single' => $request->input('single'),
                ]);
                if ($response) {
                    return redirect()->route('music.index');
                } else {
                    return redirect()->back();
                }
            }
        }

    }

}
