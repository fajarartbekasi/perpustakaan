<?php

namespace App\Http\Requests;

use App\Book;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'name' => 'required|unique:books|max:30',
            'description' => 'required|max:100',
            'penerbit' => 'required|max:30',
            'tanggal_terbit' => 'required|date',
            'stock' => 'required|integer'
        ];
    }
    public function formBook(){
        return [
            'name'              => $this->name,
            'description'       => $this->description,
            'penerbit'          => $this->penerbit,
            'tanggal_terbit'    => $this->tanggal_terbit,
            'stock'             => $this->stock,
        ];
    }
}
