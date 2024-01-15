<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function showFaqPage()
    {


        $categories = FaqCategory::with('faqItems')->get();

        return view('faq.faqPage', compact('categories'));

    }


    public function createCategory()
    {


        return view('faq.create-category');
    }


    public function storeCategory(Request $request)
    {

        $request->validate([
            'categoryName' => 'required|string',
        ]);

        $faqCategory = new FaqCategory();
        $faqCategory->categoryName = $request->categoryName;
        $faqCategory->save();


        return redirect()->route('faq.faqPage')->with('success', 'Category was made successfully');

    }

    public function createItem(FaqCategory $category)
    {


        return view('faq.create-item', compact('category'));


    }


    public function storeItem(Request $request, FaqCategory $category)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);



        $faqItem = new FaqItem();
        $faqItem->categoryId = $category->categoryId;
        $faqItem->question = $request->question;
        $faqItem->answer = $request->answer;
        $faqItem->save();

        return redirect()->route('faq.faqPage')->with('success', 'Question and Answer added successfully');
    }

    public function deleteCategory(FaqCategory $category)
    {
        //first delete the items within the category because of foreign key constraints
        $category->faqItems()->delete();

        //now delete the category
        $category->delete();

        return redirect()->back()->with('success', 'FAQ Category deleted successfully.');

    }


    public function deleteItem(FaqItem $item)
    {

        $item->delete();


        return redirect()->back()->with('success', 'FAQ Item deleted successfully.');

    }


}