<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100|min:3',
            'description' => 'required',
            'client' => 'required|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'image' => 'nullable|url|max:255',
            'project_url' => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.max' => 'Il titolo non può superare i :max caratteri.',
            'title.min' => 'Il titolo deve contenere minimo :min caratteri.',
            'description.required' => 'La descrizione è obbligatoria.',
            'client.required' => 'Il nome del cliente è obbligatorio.',
            'client.max' => 'Il nome del cliente non può superare i 100 caratteri.',
            'start_date.required' => 'La data di inizio è obbligatoria.',
            'start_date.date' => 'La data di inizio deve essere una data valida.',
            'end_date.date' => 'La data di fine deve essere una data valida.',
            'end_date.after' => 'La data di fine deve essere successiva alla data di inizio.',
            'image.url' => 'L\'immagine deve essere un URL valido.',
            'image.max' => 'L\'URL dell\'immagine non può superare i 255 caratteri.',
            'project_url.url' => 'L\'URL del progetto deve essere un URL valido.',
            'project_url.max' => 'L\'URL del progetto non può superare i 255 caratteri.',
        ];
    }
}
