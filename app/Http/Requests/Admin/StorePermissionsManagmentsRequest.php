<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionsManagmentsRequest extends FormRequest
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
            'out' => 'date_format:'.config('app.date_format').' H:i:s',
            'back' => 'nullable|date_format:'.config('app.date_format').' H:i:s',
            'reason' => '',
            'employee_id' => 'required',

            'start' => 'date_format:'.config('app.date_format').' H:i:s',
            'end' => 'date_format:'.config('app.date_format').' H:i:s',

        ];
    }
}
