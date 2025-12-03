<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    //画面表示
    public function index(Request $request)
    {
        $contacts = Contact::with('category')->paginate(7);

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));

    }

    //検索
    public function search(Request $request)
    {
        $query = Contact::query()->with('category');

        // 名前＋メール
        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);
            $keyword = str_replace([' ', '　'], '', $keyword);

            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhereRaw("REPLACE(CONCAT(last_name, first_name), ' ', '') LIKE ?", ["%{$keyword}%"])
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }


        // 性別
        if ($request->gender && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // カテゴリ
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }


    //削除
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect()->route('admin')->with('success', '削除しました');
    }


    //エクスポート
    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->keyword}%")
                    ->orWhere('first_name', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $contacts = $query->get();

        // 🟩 CSV
        $csv = "名前,性別,メール,種類\n";
        foreach ($contacts as $c) {
            $csv .= "{$c->full_name},{$c->gender_label},{$c->email},{$c->category->content}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=contacts.csv');
    }
}
