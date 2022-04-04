<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
      'name' => [
        'required',
        'string',
        'min:2',
        'max:255',
        'alpha_spaces'
      ],
      'photo'  => [
        'nullable',
        'string',
        'max:255'
      ],
      'phone'  => [
        'required',
        'string',
        'max:20'
      ],
      'email'  => [
        'required',
        'string',
        'email', 
        'min:5',
        'max:255',
        Rule::unique('users', 'email')->ignore($this->id, 'id')
      ],
      'password'  => [
        'required',
        'string',
        'min:6',
        'max:255',
      ],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
      return [
          'name.required' => 'Nome é obrigatório',
          'name.string' => 'Nome deve ser do tipo texto',
          'name.min' => 'Nome deve possuir no mínimo 2 caracteres',
          'name.max' => 'Nome deve possuir no máximo 255 caracteres',
          'name.alpha_spaces' => 'Nome só aceita letras e espaços',

          'photo.string' => 'Foto deve ser do tipo texto',
          'photo.max' => 'Foto deve possuir no máximo 255 caracteres',
          'photo.present' => 'Foto deve estar presente',

          'email.required' => 'E-mail é obrigatório',
          'email.string' => 'E-mail deve ser do tipo texto',
          'email.email' => 'E-mail inválido',
          'email.min' => 'E-mail deve possuir no mínimo 5 caracteres',
          'email.max' => 'E-mail deve possuir no máximo 255 caracteres',
          'email.unique' => 'Este e-mail já está cadastrado em outro usuário',

          'password.required' => 'Senha é obrigatório',
          'password.string' => 'Senha deve ser do tipo texto',
          'password.min' => 'Senha deve possuir no mínimo 6 caracteres',
          'password.max' => 'Senha deve possuir no máximo 255 caracteres'
      ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json($validator->errors(), 422));
  }
}
