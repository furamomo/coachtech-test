<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

use App\Models\Category;
use App\Models\Contact;



class ContactController extends Controller
{
    //  お問い合わせフォーム表示
    public function index()
    {
        $categories = Category::all();

        return view('contact.form', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $category = Category::find($contact['category_id']);
        $category_content = $category->content;

        return view('contact.confirm', compact('contact', 'category_content'));
    }

    public function back()
    {
        return redirect()->route('contact.index')->withInput();
    }

    public function store(ContactRequest $request)
    {
        $validated = $request->validated();

        $validated['tel'] = $validated['tel1'].'-'.$validated['tel2'].'-'. $validated['tel3'];

        unset($validated['tel1'], $validated['tel2'], $validated['tel3']);

        Contact::create($validated);

        return view('contact.thanks');
    }

}
