@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Listing
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.listing.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listing.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="latitude">Latitude</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" required>
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listing.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="longitude">Longitude</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="longitude" name="longitude" id="longitude" required>
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listing.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user">User</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    <option value="">--Select User--</option>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ in_array($id, old('user', [])) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listing.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
