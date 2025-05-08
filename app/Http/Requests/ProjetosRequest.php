<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetosRequest extends FormRequest
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
            'numero_projeto' => 'required|max:14',
            'cliente' => 'required|max:25',
            'unidade' => 'required|max:25',
            'nome_projeto' => 'required|max:100',
            'analista' => 'required|max:30',
            'projetista' => 'required|max:10',
            'data_fechamento' => 'required|date',
            'data_entrega' => 'required|date',
        ];
    }
}
