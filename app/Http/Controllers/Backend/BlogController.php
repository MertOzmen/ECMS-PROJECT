<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $data['blog'] = Blogs::all()->sortBy('blog_must');

        return view('backend.blogs.index', compact('data'));
    }


    public function create()
    {
        return view('backend.blogs.create');
    }


    public function store(Request $request)
    {

        if (strlen($request->blog_slug) > 3) {
            $slug = Str::slug($request->blog_slug);
        } else {
            $slug = Str::slug($request->blog_title);
        }

        if ($request->hasFile('blog_file')) {
            $request->validate([
                'blog_title' => 'required',
                'blog_content' => 'required',
                'blog_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid() . '.' . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'), $file_name);
        } else {
            $file_name = null;
        }



        $blog = Blogs::insert([
            "blog_title" => $request->blog_title,
            "blog_slug" => $slug,
            "blog_file" => $file_name,
            "blog_content" => $request->blog_content,
            "blog_status" => $request->blog_status,
        ]);

        if ($blog) {
            return redirect(route('blog.index'))->with('success', 'İşlem Başarılı');
        }

        return back()->with('error', 'İşlem Başarısız');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $blogs = Blogs::where('id', $id)->first();
        return view('backend.blogs.edit')->with('blogs', $blogs);
    }


    public function update(Request $request, $id)
    {
        if (strlen($request->blog_slug) > 3) {
            $slug = Str::slug($request->blog_slug);
        } else {
            $slug = Str::slug($request->blog_title);
        }

        if ($request->hasFile('blog_file')) {
            $request->validate([
                'blog_title' => 'required',
                'blog_content' => 'required',
                'blog_file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name = uniqid() . '.' . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'), $file_name);

            $blog = Blogs::Where('id', $id)->update(
                [
                    "blog_title" => $request->blog_title,
                    "blog_slug" => $slug, //işlem
                    "blog_file" => $file_name, //İşlem
                    "blog_content" => $request->blog_content,
                    "blog_status" => $request->blog_status,
                ]
            );

            $path = 'images/blogs/' . $request->old_file;

            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        } else {
            $blog = Blogs::Where('id', $id)->update(
                [
                    "blog_title" => $request->blog_title,
                    "blog_slug" => $slug, //işlem
                    "blog_content" => $request->blog_content,
                    "blog_status" => $request->blog_status,
                ]
            );
        }

        if ($blog) {
            return back()->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function destroy($id)
    {
        $blog = Blogs::find(intval($id));
        if ($blog->delete()) {
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $blogs = Blogs::find(intval($value));
            $blogs->blog_must = intval($key);
            $blogs->save();
        }

        echo true;
    }
}
