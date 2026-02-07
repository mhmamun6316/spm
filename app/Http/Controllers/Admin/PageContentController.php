<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePageContentRequest;
use App\Models\PageContent;

class PageContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:page_contents.edit');
    }

    public function edit()
    {
        $pageContent = PageContent::firstOrCreate([]);
        return view('admin.page-contents.edit', compact('pageContent'));
    }

    public function update(UpdatePageContentRequest $request)
    {
        $pageContent = PageContent::firstOrCreate([]);
        $data = $request->validated();
        $pageContent->update($data);

        return redirect()->route('admin.page-contents.edit')->with('success', 'Page Content updated successfully.');
    }
}

