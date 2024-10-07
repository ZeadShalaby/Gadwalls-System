<?php
namespace App\Traits\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

trait TestAuth
{

  // todo rules of login for users
  protected function rulesAuthLogin($field)
  {
    if ($field == "email") {
      return [
        "field" => "required|exists:users,email",
        "password" => "required"
      ];
    } else {
      return [
        "field" => "required|exists:users,username",
        "password" => "required"
      ];
    }
  }

  // todo rules of login for admins
  protected function rulesAdminLogin($field)
  {
    if ($field == "email") {
      return [
        "field" => "required|exists:admins,email",
        "password" => "required"
      ];
    } else {
      return [
        "field" => "required|exists:admins,username",
        "password" => "required"
      ];
    }
  }


  // todo rules of users registers
  protected function rulesRegist()
  {
    return [
      'name' => 'required|min:4|max:20',
      'password' => 'nullable|min:4',
      'email' => 'required|email|unique:users,email',
    ];
  }

  // todo rules of users Edit
  protected function rulesUpdate()
  {
    return [
      'name' => 'required|min:4|max:20',
      'password' => 'required|min:4',
      'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id),],
    ];
  }



  // todo rules store Tasks 
  protected function rulesStoreTweet()
  {
    return [
      "description" => 'required|min:4|max:250',
      // "media" => "required|mimes|image:jpg,png,gif,mp4,mov,avi,wmv|max:10240" // max size in kilobytes (10 MB)
    ];
  }


  // todo rules update Tasks 
  protected function rulesUpdateTicket()
  {
    return [
      "ticketId" => 'required|exists:tickets,id',
      "title" => 'required|unique:tickets,title',
      "description" => 'required|min:4|max:250',
      "status" => 'required',
      "due_dates" => 'required|date',
      "cat_id" => 'required|exists:categories,id',
    ];
  }

  // todo rules Add Books  
  protected function rulesAddBook()
  {
    return [
      'author_name' => 'required|string|max:255',
      'title' => 'required|string|unique:books,title|max:255',
      'language' => 'required|in:ar,en', //? Assuming you are only accepting 'ar' or 'en'
      'num_pages' => 'required|integer|min:1', //? Ensure num_pages is at least 1
      'dep_id' => 'required|exists:departments,id',
      'locations' => 'required|string|max:255', //? Assuming locations is a string
      'description' => 'required|string|min:50|max:1000', //? Fixed min and max
      'bookCover' => 'required|mimes:jpg,png,jpeg|max:2048', //? Corrected validation for image files
      'bookFile' => 'required|max:2048', //? Corrected validation for document files   mimes:pdf,ppt,doc,docx
    ];
  }

  // todo rules Add Books  
  protected function rulesReviews()
  {
    return [
      'book_id' => 'required|exists:books,id',
      'comment' => 'required|string|min:1|max:200',
      'star' => 'required|integer|max:5',
    ];
  }

  // todo rules Add Books  
  protected function rulesAddDep()
  {
    return [
      'name' => 'required|unique:departments,name',
      'code' => 'required|unique:departments,code',
      'img' => 'required|mimes:jpg,png,jpeg|max:2048', //? Corrected validation for image files

    ];
  }

  // todo rules Add Books  
  protected function rulesDepEdit($department)
  {
    return [

      'name' => ['required', Rule::unique('departments', 'name')->ignore($department),],
      'code' => ['required', Rule::unique('departments', 'code')->ignore($department),],

    ];
  }



}

