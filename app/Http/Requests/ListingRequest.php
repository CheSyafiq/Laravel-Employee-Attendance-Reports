<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class ListingRequest extends FormRequest
{
    public function authorize()
    {
        // abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required'],
            'latitude'    => [
                'required'],
            'longitude' => [
                'required'],
            'user_id'    => [
                'required'],
        ];
    }
}
